<?php

namespace App\Admin\Producten\Filament\Resources\Producten\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('naam')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('prijs')
                    ->money('EUR')
                    ->sortable(),

                TextColumn::make('restaurant.naam'),

                TextColumn::make('categorieen.naam')
                    ->label('Categorieën'),

                TextColumn::make('allergieen.naam')
                    ->label('Allergieën'),
            ])
            ->filters([
                SelectFilter::make('restaurant')
                    ->label('Restaurants')
                    ->relationship('restaurant', 'naam')
                    ->multiple()
                    ->preload(),

                SelectFilter::make('categorieen')
                    ->label('Categorieën')
                    ->relationship('categorieen', 'naam')
                    ->multiple()
                    ->preload(),

                SelectFilter::make('allergieen')
                    ->label('Allergieën')
                    ->relationship('allergieen', 'naam')
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
