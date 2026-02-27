<?php

namespace App\Admin\Producten;

use Filament\Contracts\Plugin;
use Filament\Panel;

class ProductenPlugin implements Plugin
{
    public function getId(): string
    {
        return 'producten';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(
                in: __DIR__.'/Filament/Resources',
                for: 'App\\Admin\\Producten\\Filament\\Resources'
            )
            ->discoverPages(
                in: __DIR__.'/Filament/Pages',
                for: 'App\\Admin\\Producten\\Filament\\Pages'
            )
            ->discoverWidgets(
                in: __DIR__.'/Filament/Pages/Widgets',
                for: 'App\\Admin\\Producten\\Filament\\Pages\\Widgets'
            );
    }

    public function boot(Panel $panel): void {}
}
