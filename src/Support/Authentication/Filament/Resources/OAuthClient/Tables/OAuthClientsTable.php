<?php

namespace Support\Authentication\Filament\Resources\OAuthClient\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Support\Authentication\Filament\Actions\RegenerateSecretAction;
use Support\Authentication\Filament\Actions\ToggleClientStatusAction;

class OAuthClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('id')
                    ->label('Client ID')
                    ->searchable()
                    ->copyable()
                    ->sortable(),

                IconColumn::make('revoked')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('revoked')
                    ->label('Status')
                    ->options([
                        '0' => 'Active',
                        '1' => 'Revoked',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                ToggleClientStatusAction::make(),
                RegenerateSecretAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
