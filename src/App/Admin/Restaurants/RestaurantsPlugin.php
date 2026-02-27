<?php

namespace App\Admin\Restaurants;

use Filament\Contracts\Plugin;
use Filament\Panel;

class RestaurantsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'restaurants';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(
                in: __DIR__.'/Filament/Resources',
                for: 'App\\Admin\\Restaurants\\Filament\\Resources'
            )
            ->discoverPages(
                in: __DIR__.'/Filament/Pages',
                for: 'App\\Admin\\Restaurants\\Filament\\Pages'
            )
            ->discoverWidgets(
                in: __DIR__.'/Filament/Pages/Widgets',
                for: 'App\\Admin\\Restaurants\\Filament\\Pages\\Widgets'
            );
    }

    public function boot(Panel $panel): void {}
}
