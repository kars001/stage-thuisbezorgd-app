<?php

namespace Support\Authentication\LoginConfiguration;

use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class DefaultLoginConfiguration extends AbstractLoginConfiguration
{
    /**
     * @return array<int, mixed>
     */
    public function getFeatures(): array
    {
        return [
            Features::resetPasswords(),
            Features::updateProfileInformation(),
            Features::updatePasswords(),
        ];
    }

    public static function usesAuthenticator(): bool
    {
        return false;
    }

    public static function getLoginFormView(): string
    {
        return 'auth.login-default';
    }

    public function setupViews(): void
    {
        Fortify::registerView(static function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(static function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(static function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(static function () {
            return view('auth.verify-email');
        });

        Fortify::confirmPasswordView(static function () {
            return view('auth.confirm-password');
        });
    }
}
