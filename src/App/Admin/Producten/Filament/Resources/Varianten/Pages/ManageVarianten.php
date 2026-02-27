<?php

namespace App\Admin\Producten\Filament\Resources\Varianten\Pages;

use App\Admin\Producten\Filament\Resources\Varianten\VariantenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageVarianten extends ManageRecords
{
    protected static string $resource = VariantenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
