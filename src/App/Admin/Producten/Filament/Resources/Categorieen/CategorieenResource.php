<?php

namespace App\Admin\Producten\Filament\Resources\Categorieen;

use App\Admin\Producten\Filament\Resources\Categorieen\Pages\EditCategorieen;
use App\Admin\Producten\Filament\Resources\Categorieen\Pages\ManageCategorieen;
use App\Admin\Producten\Filament\Resources\Categorieen\Schemas\CategorieenForm;
use App\Admin\Producten\Filament\Resources\Categorieen\Tables\CategorieenTable;
use BackedEnum;
use Domain\Producten\Models\Categorie;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategorieenResource extends Resource
{
    protected static ?string $model = Categorie::class;
    protected static ?string $slug = 'categorieen';
    protected static ?string $navigationLabel = 'Categorieen';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|null|\UnitEnum $navigationGroup = 'Producten';
    protected static ?int $navigationSort = 2;

    public static function getLabel(): string
    {
        return 'Categorie';
    }

    public static function getPluralLabel(): string
    {
        return 'Categorieen';
    }

    public static function form(Schema $schema): Schema
    {
        return CategorieenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategorieenTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCategorieen::route('/'),
            'edit' => EditCategorieen::route('/{record}/edit'),
        ];
    }
}
