<?php

namespace Support\Authentication\Filament\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Support\Authentication\Enums\OAuthConnectionTypesEnum;

class RegenerateSecretAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'regenerate_secret';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Regenerate Secret')
            ->icon('heroicon-o-key')
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Regenerate Client Secret')
            ->modalDescription('Are you sure you want to regenerate the client secret? The old secret will no longer work.')
            ->modalSubmitActionLabel('Regenerate')
            ->visible(function (Client $record): bool {
                if ($record->revoked) {
                    return false;
                }

                if ($record->hasGrantType(OAuthConnectionTypesEnum::CLIENT_CREDENTIALS->value)) {
                    return true;
                }

                if ($record->hasGrantType(OAuthConnectionTypesEnum::AUTHORIZATION_CODE->value)) {
                    return $record->confidential();
                }

                return false;
            })
            ->action(function (Client $record): void {
                $newSecret = Str::random(40);
                $record->setAttribute('secret', $newSecret);
                $record->save();

                Notification::make()
                    ->title('Client secret regenerated')
                    ->body(sprintf("Please save the new client secret as it won't be shown again: %s", $newSecret))
                    ->warning()
                    ->persistent()
                    ->send();
            });
    }
}
