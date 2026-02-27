<?php

namespace App\Admin\Producten\Filament\Resources\Varianten;

use App\Admin\Producten\Filament\Resources\Varianten\Pages\EditVarianten;
use App\Admin\Producten\Filament\Resources\Varianten\Pages\ManageVarianten;
use App\Admin\Producten\Filament\Resources\Varianten\Schemas\VariantenForm;
use App\Admin\Producten\Filament\Resources\Varianten\Tables\VariantenTable;
use BackedEnum;
use Domain\Producten\Models\Varianten;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VariantenResource extends Resource
{
    protected static ?string $model = Varianten::class;
    protected static ?string $slug = 'varianten';
    protected static ?string $navigationLabel = 'Varianten';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|null|\UnitEnum $navigationGroup = 'Producten';
    protected static ?int $navigationSort = 5;

    public static function getLabel(): string
    {
        return 'Variant';
    }

    public static function getPluralLabel(): string
    {
        return 'Varianten';
    }

    public static function form(Schema $schema): Schema
    {
        return VariantenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VariantenTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageVarianten::route('/'),
            'edit' => EditVarianten::route('/{record}/edit'),
        ];
    }
}
