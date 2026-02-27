<?php

namespace Support\Authentication\Filament\Resources\OAuthClient\Pages;

use Domain\Users\Actions\UpdateClientAction;
use Domain\Users\DataTransferObjects\ClientUpsertData;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client;
use Support\Authentication\Filament\Actions\RegenerateSecretAction;
use Support\Authentication\Filament\Actions\ToggleClientStatusAction;
use Support\Authentication\Filament\Resources\OAuthClient\OAuthClientResource;

class EditOAuthClient extends EditRecord
{
    protected static string $resource = OAuthClientResource::class;

    /**
     * @param Model $record
     * @param array<string, mixed> $data
     * @return Model
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $clientData = new ClientUpsertData(...$data);

        /** @var Client $client */
        $client = $record;

        return app(UpdateClientAction::class)->execute($client, $clientData);
    }

    protected function getHeaderActions(): array
    {
        return [
            RegenerateSecretAction::make(),
            ToggleClientStatusAction::make(),
            DeleteAction::make()
                ->requiresConfirmation(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        /** @var Client $client */
        $client = $this->record;

        if (isset($client->plainSecret)) {
            Notification::make()
                ->body(sprintf("Please save the client secret as it won't be shown again: %s", $client->plainSecret))
                ->warning()
                ->persistent()
                ->send();
        }
    }
}
