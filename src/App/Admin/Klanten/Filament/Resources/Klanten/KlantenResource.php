<?php

namespace App\Admin\Klanten\Filament\Resources\Klanten;

use App\Admin\Klanten\Filament\Resources\Klanten\Pages\ManageKlanten;
use App\Admin\Klanten\Filament\Resources\Klanten\Tables\KlantenTable;
use BackedEnum;
use Domain\Klanten\Models\Klanten;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KlantenResource extends Resource
{
    protected static ?string $model = Klanten::class;
    protected static ?string $slug = 'klanten';
    protected static ?string $navigationLabel = 'Klanten';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function getLabel(): string
    {
        return 'Klanten';
    }

    public static function getPluralLabel(): string
    {
        return 'Klanten';
    }

    public static function table(Table $table): Table
    {
        return KlantenTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageKlanten::route('/'),
        ];
    }
}
