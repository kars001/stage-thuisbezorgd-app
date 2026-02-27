<?php

namespace App\Admin\Producten\Filament\Resources\Allergieen\Pages;

use App\Admin\Producten\Filament\Resources\Allergieen\AllergieenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAllergieen extends ManageRecords
{
    protected static string $resource = AllergieenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
