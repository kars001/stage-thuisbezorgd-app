<?php

namespace App\Admin\Bestellingen;

use Filament\Contracts\Plugin;
use Filament\Panel;

class BestellingenPlugin implements Plugin
{
    public function getId(): string
    {
        return 'bestellingen';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(
                in: __DIR__.'/Filament/Resources',
                for: 'App\\Admin\\Bestellingen\\Filament\\Resources'
            )
            ->discoverPages(
                in: __DIR__.'/Filament/Pages',
                for: 'App\\Admin\\Bestellingen\\Filament\\Pages'
            )
            ->discoverWidgets(
                in: __DIR__.'/Filament/Pages/Widgets',
                for: 'App\\Admin\\Bestellingen\\Filament\\Pages\\Widgets'
            );
    }

    public function boot(Panel $panel): void {}
}
