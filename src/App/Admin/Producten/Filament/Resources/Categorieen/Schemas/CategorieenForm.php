<?php

namespace App\Admin\Producten\Filament\Resources\Categorieen\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategorieenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('naam')
                    ->required()
                    ->unique(),
            ]);
    }
}
