<?php

namespace App\Admin\Klanten\Filament\Resources\Klanten\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KlantenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('voornaam')
                    ->searchable(),

                TextColumn::make('achternaam'),

                TextColumn::make('adres'),

                TextColumn::make('email'),

                TextColumn::make('telefoonnummer'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
