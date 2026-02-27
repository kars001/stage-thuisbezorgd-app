<?php

namespace Support\Settings\Pages;

use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Support\Settings\PassportSettings;

class ManagePassport extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string $settings = PassportSettings::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('token_lifetime')
                    ->numeric()
                    ->integer()
                    ->required(),
                TextInput::make('refresh_token_lifetime')
                    ->numeric()
                    ->integer()
                    ->required(),
                Toggle::make('prune_revoked_tokens')
                    ->columnSpanFull()
                    ->required(),
                Toggle::make('prune_auth_codes')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
