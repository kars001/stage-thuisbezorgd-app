<?php

namespace App\Admin\Producten\Filament\Resources\Varianten\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VariantenForm
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
