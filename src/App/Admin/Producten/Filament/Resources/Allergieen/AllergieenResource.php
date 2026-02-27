<?php

namespace App\Admin\Producten\Filament\Resources\Allergieen;

use App\Admin\Producten\Filament\Resources\Allergieen\Pages\EditAllergieen;
use App\Admin\Producten\Filament\Resources\Allergieen\Pages\ManageAllergieen;
use App\Admin\Producten\Filament\Resources\Allergieen\Schemas\AllergieenForm;
use App\Admin\Producten\Filament\Resources\Allergieen\Tables\AllergieenTable;
use BackedEnum;
use Domain\Producten\Models\Allergieen;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AllergieenResource extends Resource
{
    protected static ?string $model = Allergieen::class;
    protected static ?string $slug = 'allergieen';
    protected static ?string $navigationLabel = 'Allergieen';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|null|\UnitEnum $navigationGroup = 'Producten';
    protected static ?int $navigationSort = 3;

    public static function getLabel(): string
    {
        return 'Allergie';
    }

    public static function getPluralLabel(): string
    {
        return 'Allergieen';
    }

    public static function form(Schema $schema): Schema
    {
        return AllergieenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AllergieenTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAllergieen::route('/'),
            'edit' => EditAllergieen::route('/{record}/edit'),
        ];
    }
}
