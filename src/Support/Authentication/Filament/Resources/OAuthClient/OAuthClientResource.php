<?php

namespace Support\Authentication\Filament\Resources\OAuthClient;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\Client;
use Support\Authentication\Filament\Resources\OAuthClient\Pages\CreateOAuthClient;
use Support\Authentication\Filament\Resources\OAuthClient\Pages\EditOAuthClient;
use Support\Authentication\Filament\Resources\OAuthClient\Pages\ListOAuthClients;
use Support\Authentication\Filament\Resources\OAuthClient\Schemas\OAuthClientForm;
use Support\Authentication\Filament\Resources\OAuthClient\Tables\OAuthClientsTable;

class OAuthClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $slug = 'oauth-clients';

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    protected static ?int $navigationSort = 100;

    public static function form(Schema $schema): Schema
    {
        return OAuthClientForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OAuthClientsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOAuthClients::route('/'),
            'create' => CreateOAuthClient::route('/create'),
            'edit' => EditOAuthClient::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'OAuth Clients';
    }

    public static function getModelLabel(): string
    {
        return 'OAuth Client';
    }

    public static function getPluralModelLabel(): string
    {
        return 'OAuth Clients';
    }

    /**
     * @return Builder<Client>
     */
    public static function getEloquentQuery(): Builder
    {
        /** @var Builder<Client> $query */
        $query = parent::getEloquentQuery();

        return $query->orderBy('name');
    }
}
