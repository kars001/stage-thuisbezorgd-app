<?php

namespace App\Admin\User;

use Filament\Contracts\Plugin;
use Filament\Panel;

class UserPlugin implements Plugin
{
    public function getId(): string
    {
        return 'user';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(
                in: __DIR__.'/Filament/Resources',
                for: 'App\\Admin\\User\\Filament\\Resources'
            )
            ->discoverPages(
                in: __DIR__.'/Filament/Pages',
                for: 'App\\Admin\\User\\Filament\\Pages'
            )
            ->discoverWidgets(
                in: __DIR__.'/Filament/Pages/Widgets',
                for: 'App\\Admin\\User\\Filament\\Pages\\Widgets'
            );
    }

    public function boot(Panel $panel): void {}
}
