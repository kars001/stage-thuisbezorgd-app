<?php

namespace Support\Authentication\Filament\Resources\OAuthClient\Pages;

use Domain\Users\Actions\CreateClientAction;
use Domain\Users\DataTransferObjects\ClientUpsertData;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client;
use Support\Authentication\Filament\Resources\OAuthClient\OAuthClientResource;

class CreateOAuthClient extends CreateRecord
{
    protected static string $resource = OAuthClientResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $clientData = new ClientUpsertData(...$data);

        return app(CreateClientAction::class)->execute($clientData);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        /** @var Client $client */
        $client = $this->record;

        if (isset($client->plainSecret)) {
            Notification::make()
                ->title('Client created successfully')
                ->body(sprintf("Please save the client secret as it won't be shown again: %s", $client->plainSecret))
                ->warning()
                ->persistent()
                ->send();
        }
    }
}
