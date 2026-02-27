<?php

namespace App\Admin\Bestellingen\Filament\Resources\Bestellingen;

use App\Admin\Bestellingen\Filament\Resources\Bestellingen\Pages\EditBestellingen;
use App\Admin\Bestellingen\Filament\Resources\Bestellingen\Pages\ManageBestellingen;
use App\Admin\Bestellingen\Filament\Resources\Bestellingen\Schemas\BestellingenForm;
use App\Admin\Bestellingen\Filament\Resources\Bestellingen\Tables\BestellingenTable;
use BackedEnum;
use Domain\Bestellingen\Models\Bestellingen;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Schemas\Schema;

class BestellingenResource extends Resource
{
    protected static ?string $model = Bestellingen::class;
    protected static ?string $slug = 'bestellingen';
    protected static ?string $navigationLabel = 'Bestellingen';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function getLabel(): string
    {
        return 'Bestellingen';
    }

    public static function getPluralLabel(): string
    {
        return 'Bestellingen';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function table(Table $table): Table
    {
        return BestellingenTable::configure($table);
    }

    public static function form(Schema $schema): Schema
    {
        return BestellingenForm::configure($schema);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBestellingen::route('/'),
            'edit' => EditBestellingen::route('/{record}/edit'),
        ];
    }
}
