<?php

namespace Support\Authentication\Filament\Actions;

use Filament\Actions\Action;
use Laravel\Passport\Client;

class ToggleClientStatusAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'toggle_status';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn(Client $record): string => $record->revoked ? 'Activate' : 'Deactivate')
            ->icon(fn(Client $record): string => $record->revoked ? 'heroicon-o-check' : 'heroicon-o-x-mark')
            ->color(fn(Client $record): string => $record->revoked ? 'success' : 'danger')
            ->requiresConfirmation()
            ->action(function (Client $record): void {
                $record->revoked = !$record->revoked;
                $record->save();
            });
    }
}
