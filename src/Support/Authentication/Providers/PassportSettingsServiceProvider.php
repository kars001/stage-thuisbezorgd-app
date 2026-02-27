<?php

namespace Support\Authentication\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Support\Settings\PassportSettings;

class PassportSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            $settings = app(PassportSettings::class);

            // Set token lifetimes
            Passport::tokensExpireIn(now()->addSeconds($settings->token_lifetime));
            Passport::refreshTokensExpireIn(now()->addSeconds($settings->refresh_token_lifetime));
        } catch (\Throwable $e) {
            Passport::tokensExpireIn(now()->addDay());
            Passport::refreshTokensExpireIn(now()->addDays(30));
        }

        // Bind the authorization view response using a Blade view to keep HTML out of PHP
        Passport::authorizationView('auth.oauth.authorize');
    }
}
