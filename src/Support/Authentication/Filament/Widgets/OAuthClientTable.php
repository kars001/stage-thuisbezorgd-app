<?php

namespace Support\Authentication\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Laravel\Passport\Client;

class OAuthClientTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Client::query()
            )
            ->columns([
                // ...
            ]);
    }
}
