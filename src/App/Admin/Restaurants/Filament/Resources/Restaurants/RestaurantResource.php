<?php

namespace App\Admin\Restaurants\Filament\Resources\Restaurants;

use App\Admin\Restaurants\Filament\Resources\Restaurants\Pages\CreateRestaurant;
use App\Admin\Restaurants\Filament\Resources\Restaurants\Pages\EditRestaurant;
use App\Admin\Restaurants\Filament\Resources\Restaurants\Pages\ManageRestaurants;
use App\Admin\Restaurants\Filament\Resources\Restaurants\Schemas\RestaurantForm;
use App\Admin\Restaurants\Filament\Resources\Restaurants\Tables\RestaurantsTable;
use BackedEnum;
use Domain\Restaurants\Models\Restaurant;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RestaurantResource extends Resource
{
    protected static ?string $model = Restaurant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    public static function form(Schema $schema): Schema
    {
        return RestaurantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RestaurantsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageRestaurants::route('/'),
            'create' => CreateRestaurant::route('/create'),
            'edit' => EditRestaurant::route('/{record}/edit'),
        ];
    }
}
