<?php

namespace App\Admin\User\Filament\Resources\User\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(),
                TextInput::make('password')
                    ->password()
                    ->confirmed()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required()
                    ->visibleOn(['create']),
                TextInput::make('password_confirmation')
                    ->required()
                    ->dehydrated(false)
                    ->password()
                    ->visibleOn(['create']),
            ]);
    }
}
