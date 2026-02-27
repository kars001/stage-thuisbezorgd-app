<?php

namespace Support\Settings\Pages;

use BackedEnum;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Support\Settings\AppearanceSettings;

class ManageAppearance extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string $settings = AppearanceSettings::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                ColorPicker::make('primary_color')
                    ->required(),
                ColorPicker::make('secondary_color')
                    ->required(),
                TextInput::make('font_family')
                    ->columnSpanFull()
                    ->required(),
                FileUpload::make('logo_path')
                    ->image()
                    ->directory('images')
                    ->disk('public')
                    ->visibility('public')
                    ->required(),
                FileUpload::make('favicon_path')
                    ->image()
                    ->directory('images')
                    ->disk('public')
                    ->visibility('public')
                    ->required(),
            ]);
    }
}
