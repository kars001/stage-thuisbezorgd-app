<?php

namespace App\Admin\Providers\Filament;

use App\Admin\Bestellingen\BestellingenPlugin;
use App\Admin\Klanten\KlantenPlugin;
use App\Admin\Producten\ProductenPlugin;
use App\Admin\Restaurants\RestaurantsPlugin;
use App\Admin\User\UserPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Enums\Width;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Support\Settings\AppearanceSettings;
use Support\Authentication\Filament\Resources\OAuthClient\OAuthClientResource;
use Support\Settings\Pages\ManageAppearance;
use Support\Settings\Pages\ManagePassport;
use Support\Settings\Pages\Settings;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // Get appearance settings
        try {
            $appearanceSettings = app(AppearanceSettings::class);

            // Convert hex color to rgb values for Filament
            $primaryColor = $appearanceSettings->primary_color ?? AppearanceSettings::DEFAULT_PRIMARY_COLOR;
            $secondaryColor = $appearanceSettings->secondary_color ?? AppearanceSettings::DEFAULT_SECONDARY_COLOR;
            $fontFamily = $appearanceSettings->font_family ?? 'inter';
            $faviconPath = $appearanceSettings->favicon_path ? '/storage/' . $appearanceSettings->favicon_path : '/favicon.ico';
        } catch (\Throwable $e) {
            // If settings are not available (e.g., during testing), use defaults
            $primaryColor = AppearanceSettings::DEFAULT_PRIMARY_COLOR;
            $secondaryColor = AppearanceSettings::DEFAULT_SECONDARY_COLOR;
            $fontFamily = 'inter';
            $faviconPath = '/favicon.ico';
        }

        return $panel
            ->default()
            ->id('admin')
            ->colors([
                'primary' => $primaryColor,
                'secondary' => $secondaryColor,
            ])
            ->maxContentWidth(Width::Full)
            ->font($fontFamily)
            ->favicon($faviconPath)
            ->pages([
                Dashboard::class,
                ManageAppearance::class,
                ManagePassport::class
            ])
            ->resources([
                OAuthClientResource::class,
            ])
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                new UserPlugin,
                new ProductenPlugin,
                new RestaurantsPlugin,
                new KlantenPlugin,
                new BestellingenPlugin,
            ])
            ->navigationGroups([
                'Producten',
                'Settings',
            ])
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn() => view('auth.socialite.google')
            );
    }
}
