<?php

namespace App\Admin\Producten\Filament\Resources\Producten\Schemas;

use Domain\Restaurants\Models\Restaurant;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ProductenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->components([
                        TextInput::make('naam')
                            ->required(),

                        TextInput::make('prijs')
                            ->numeric()
                            ->prefix('€')
                            ->minValue(0)
                            ->placeholder('0.00')
                            ->required(),

                        Select::make('restaurant_id')
                            ->searchable(false)
                            ->options(Restaurant::query()->pluck('naam', 'id'))
                            ->label('Restaurant')
                            ->native(false)
                            ->required(),

                    ])->columnSpanFull(),

                Textarea::make('beschrijving')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),

                Grid::make(2)
                    ->components([
                        Select::make('categorie')
                            ->relationship('categorieen', 'naam')
                            ->multiple()
                            ->searchable(false)
                            ->preload()
                            ->native(false)
                            ->label('Categorieën')
                            ->createOptionForm([
                                TextInput::make('naam')
                                    ->required(),
                            ]),

                        Select::make('allergieen')
                            ->relationship('allergieen', 'naam')
                            ->multiple()
                            ->searchable(false)
                            ->preload()
                            ->native(false)
                            ->label('Allergieën')
                            ->createOptionForm([
                                TextInput::make('naam')
                                    ->required(),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
