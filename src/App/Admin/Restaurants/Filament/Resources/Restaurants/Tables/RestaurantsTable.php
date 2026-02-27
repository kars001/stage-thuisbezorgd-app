<?php

namespace App\Admin\Restaurants\Filament\Resources\Restaurants\Tables;

use Domain\Restaurants\Enums\RestaurantStatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RestaurantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('naam')
                    ->searchable(),

                TextColumn::make('adres'),

                TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn (RestaurantStatusEnum $state): string => $state->getLabel())
                    ->color(fn (RestaurantStatusEnum $state): string => $state->getColor()),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Restaurant status')
                    ->options(RestaurantStatusEnum::class)
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
