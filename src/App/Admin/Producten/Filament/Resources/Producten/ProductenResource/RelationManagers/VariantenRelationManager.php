<?php

namespace App\Admin\Producten\Filament\Resources\Producten\ProductenResource\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariantenRelationManager extends RelationManager
{
    protected static string $relationship = 'varianten';
    protected static ?string $inverseRelationship = 'producten';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('naam')
            ->columns([
                TextColumn::make('naam'),
                TextColumn::make('extra_prijs')
                    ->money('EUR')
                    ->label('Extra prijs'),
            ])
            ->filters([

            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()

                    ->schema(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        TextInput::make('extra_prijs')
                            ->numeric()
                            ->prefix('€')
                            ->placeholder('0.00')
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                    ])
            ])
            ->recordActions([
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
