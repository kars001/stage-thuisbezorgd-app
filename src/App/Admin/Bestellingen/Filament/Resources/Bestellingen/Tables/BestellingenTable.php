<?php

namespace App\Admin\Bestellingen\Filament\Resources\Bestellingen\Tables;

use Domain\Bestellingen\Enums\BestellingStatusEnum;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BestellingenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('restaurant.naam')
                    ->searchable(),

                TextColumn::make('klanten.voornaam')
                    ->label('Klant voornaam')
                    ->searchable(),

                TextColumn::make('klanten.achternaam')
                    ->label('Klant achternaam')
                    ->searchable(),

                TextColumn::make('totaalprijs')
                    ->money('EUR'),

                TextColumn::make('verzendkosten')
                    ->money('EUR'),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (BestellingStatusEnum $state): string => $state->getLabel())
                    ->color(fn (BestellingStatusEnum $state): string => $state->getColor()),
            ])
            ->filters([
                SelectFilter::make('restaurant')
                    ->label('Restaurants')
                    ->relationship('restaurant', 'naam')
                    ->multiple()
                    ->preload(),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options(BestellingStatusEnum::class)
                    ->multiple()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
