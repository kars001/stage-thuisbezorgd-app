<?php

namespace Support\Authentication\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Events\TwoFactorAuthenticationChallenged;
use Laravel\Fortify\Fortify;
use Support\Authentication\Enums\LoginType;
use Support\Authentication\Listeners\SendTwoFactorCodeListener;
use Support\Authentication\LoginConfiguration\AbstractLoginConfiguration;
use Support\Authentication\LoginConfiguration\LoginConfigurationFactory;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AbstractLoginConfiguration::class,
            function () {
                return LoginConfigurationFactory::getImplementation();
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app(AbstractLoginConfiguration::class)->configureLogin();

        if (config('auth.login_type') === LoginType::OTP->value) {
            Event::listen(TwoFactorAuthenticationChallenged::class, SendTwoFactorCodeListener::class);
        }

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
