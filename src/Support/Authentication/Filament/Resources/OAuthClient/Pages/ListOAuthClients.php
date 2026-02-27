<?php

namespace Support\Authentication\Filament\Resources\OAuthClient\Pages;

use Support\Authentication\Filament\Resources\OAuthClient\OAuthClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOAuthClients extends ListRecords
{
    protected static string $resource = OAuthClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
