<?php

namespace App\Admin\Producten\Filament\Resources\Categorieen\Pages;

use App\Admin\Producten\Filament\Resources\Categorieen\CategorieenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCategorieen extends ManageRecords
{
    protected static string $resource = CategorieenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
