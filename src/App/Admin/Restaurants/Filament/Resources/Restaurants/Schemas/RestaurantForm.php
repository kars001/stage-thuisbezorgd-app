<?php

namespace App\Admin\Restaurants\Filament\Resources\Restaurants\Schemas;

use Domain\Restaurants\Enums\RestaurantStatusEnum;
use Domain\Restaurants\Enums\RestaurantWeekDaysEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class RestaurantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Stap 1')
                        ->schema([
                            TextInput::make('naam')
                                ->required(),

                            Textarea::make('beschrijving')
                                ->required(),

                            TextInput::make('adres'),

                            Select::make('status')
                                ->options(
                                    RestaurantStatusEnum::class
                                )->required()
                                ->native(false),
                        ]),

                    Step::make('Stap 2')
                        ->schema([
                            TextInput::make('minimaal_bestelbedrag')
                                ->numeric()
                                ->prefix('€')
                                ->minValue(0)
                                ->placeholder('0.00'),

                            TextInput::make('bezorgkosten')
                                ->numeric()
                                ->prefix('€')
                                ->minValue(0)
                                ->placeholder('0.00'),

                            TagsInput::make('bezorggebied')
                                ->label('Bezorggebied (postcodes)')
                                ->placeholder('0000AB')
                                ->required(),
                        ]),

                    Step::make('Stap 3')
                        ->schema([
                            FileUpload::make('logo_url')
                                ->directory('logos')
                                ->disk('public')
                                ->visibility('public')
                                ->label('Logo')
                                ->image(),

                            FileUpload::make('header_url')
                                ->directory('headers')
                                ->disk('public')
                                ->visibility('public')
                                ->label('Header')
                                ->image(),

                            Repeater::make('open_en_sluit_tijden')
                                ->schema([
                                    Select::make('dag')
                                        ->options(RestaurantWeekDaysEnum::class)
                                        ->disabled()
                                        ->dehydrated(true)
                                        ->required(),

                                    TimePicker::make('open_tijd')
                                        ->seconds(false)
                                        ->native(false)
                                        ->required(),

                                    TimePicker::make('sluit_tijd')
                                        ->seconds(false)
                                        ->native(false)
                                        ->required(),
                                ])
                                ->default(
                                    collect(RestaurantWeekDaysEnum::cases())
                                        ->map(fn($day) => [
                                            'dag' => $day->value,
                                            'open_tijd' => null,
                                            'sluit_tijd' => null,
                                        ])
                                        ->toArray()
                                )
                                ->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                                ->columns(3)
                                ->required(),
                        ]),
                ]),
            ]);
    }
}
