<?php

namespace App\Admin\Klanten;

use Filament\Contracts\Plugin;
use Filament\Panel;

class KlantenPlugin implements Plugin
{
    public function getId(): string
    {
        return 'klanten';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(
                in: __DIR__.'/Filament/Resources',
                for: 'App\\Admin\\Klanten\\Filament\\Resources'
            )
            ->discoverPages(
                in: __DIR__.'/Filament/Pages',
                for: 'App\\Admin\\Klanten\\Filament\\Pages'
            )
            ->discoverWidgets(
                in: __DIR__.'/Filament/Pages/Widgets',
                for: 'App\\Admin\\Klanten\\Filament\\Pages\\Widgets'
            );
    }

    public function boot(Panel $panel): void {}
}
