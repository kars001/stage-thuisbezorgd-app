<?php

namespace App\Admin\Producten\Filament\Resources\Producten;

use App\Admin\Producten\Filament\Resources\Producten\Pages\CreateProducten;
use App\Admin\Producten\Filament\Resources\Producten\Pages\EditProducten;
use App\Admin\Producten\Filament\Resources\Producten\Pages\ManageProducten;
use App\Admin\Producten\Filament\Resources\Producten\ProductenResource\RelationManagers\VariantenRelationManager;
use App\Admin\Producten\Filament\Resources\Producten\Schemas\ProductenForm;
use App\Admin\Producten\Filament\Resources\Producten\Tables\ProductenTable;
use BackedEnum;
use Domain\Producten\Models\Producten;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductenResource extends Resource
{
    protected static ?string $model = Producten::class;
    protected static ?string $slug = 'producten';
    protected static ?string $navigationLabel = 'Producten';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|null|\UnitEnum $navigationGroup = 'Producten';
    protected static ?int $navigationSort = 1;

    public static function getLabel(): string
    {
        return 'Product';
    }

    public static function getPluralLabel(): string
    {
        return 'Producten';
    }

    public static function form(Schema $schema): Schema
    {
        return ProductenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductenTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProducten::route('/'),
            'create' => CreateProducten::route('/create'),
            'edit' => EditProducten::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            VariantenRelationManager::class,
        ];
    }
}
