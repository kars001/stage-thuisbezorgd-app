<?php

namespace Support\Authentication\Filament\Resources\OAuthClient\Schemas;

use Domain\Users\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Collection;
use Laravel\Passport\Client;
use Support\Authentication\Enums\OAuthConnectionTypesEnum;

class OAuthClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Select::make('type')
                            ->options(OAuthConnectionTypesEnum::getCasesForSelect())
                            ->live()
                            ->required()
                            ->afterStateHydrated(function (Select $component, $state, ?Client $record) {
                                if (!isset($record->grant_types)) {
                                    return;
                                }

                                foreach ($record->grant_types as $grantType) {
                                    if (in_array($grantType, [
                                        OAuthConnectionTypesEnum::AUTHORIZATION_CODE->value,
                                        OAuthConnectionTypesEnum::CLIENT_CREDENTIALS->value
                                    ])) {
                                        $component->state($grantType);
                                        break;
                                    }
                                }
                            }),

                        TextEntry::make('explanation')
                            ->visible(fn(Get $get) => !empty($get('type')))
                            ->state(
                                fn(Get $get) => $get('type') ? OAuthConnectionTypesEnum::getHelperTextForKey(
                                    $get('type')
                                ) : ''
                            ),

                        Checkbox::make('confidential')
                            ->label('Confidential Client')
                            ->helperText('Confidential clients can securely store a client secret')
                            ->default(false)
                            ->live()
                            ->visible(fn(Get $get) => $get('type') === OAuthConnectionTypesEnum::AUTHORIZATION_CODE->value)
                            ->afterStateHydrated(function (Checkbox $component, ?Client $record) {
                                if ($record) {
                                    $component->state($record->confidential());
                                }
                            }),

                        Select::make('owner_id')
                            ->label('User (optional)')
                            ->options(fn() => User::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->visible(fn(Get $get) => $get('type') === OAuthConnectionTypesEnum::AUTHORIZATION_CODE->value),

                        TextEntry::make('id')
                            ->label('Client ID')
                            ->state(function (?Client $record): string {
                                return $record && $record->id ? (string)$record->id : 'Will be generated';
                            })
                        ,

                        TextEntry::make('secret')
                            ->label('Client Secret')
                            ->state(function (?Client $record): string {
                                return $record && $record->plainSecret ? $record->plainSecret : 'Will be generated';
                            })
                            ->visible(function (?Client $record, Get $get) {
                                return ($get('confidential') === true) || ($get('type') === OAuthConnectionTypesEnum::CLIENT_CREDENTIALS->value);
                            })
                        ,
                    ]),

                Section::make('Redirect URIs')
                    ->schema([
                        Repeater::make('redirect_uris')
                            ->label('Redirect URIs')
                            ->schema([
                                TextInput::make('uri')
                                    ->label('URI')
                                    ->required()
                                    ->url()
                                    ->maxLength(2000),
                            ])
                            ->required()
                            ->minItems(1)
                            ->defaultItems(1)
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->afterStateHydrated(function (Repeater $component, $state) {
                                /** @var array<int, string|array<string, string>> $state */
                                /** @var Collection<int, string|array<string, string>> $collection */
                                $collection = collect($state);
                                $component->state($collection
                                    ->filter(function ($record) {
                                        $uri = is_array($record) ? ($record['uri'] ?? null) : $record;
                                        return !empty($uri);
                                    })
                                    ->map(function ($record) {
                                        return ['uri' => $record];
                                    })
                                    ->values()
                                    ->toArray()
                                );
                            })
                            ->dehydrateStateUsing(function ($state) {
                                /** @var array<int, array<string, string>> $state */
                                /** @var Collection<int, array<string, string>> $collection */
                                $collection = collect($state);
                                return $collection->pluck('uri')->toArray();
                            })
                    ]),
            ]);
    }
}
