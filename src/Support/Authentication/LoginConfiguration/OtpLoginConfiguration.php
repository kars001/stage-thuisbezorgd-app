<?php

namespace Support\Authentication\LoginConfiguration;

use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use Support\Authentication\Exceptions\AccountConfigurationException;
use Support\Authentication\Requests\PasswordlessLoginRequest;

class OtpLoginConfiguration extends AbstractLoginConfiguration
{
    /**
     * @return array<int, mixed>
     */
    public function getFeatures(): array
    {
        return [
            Features::registration(),
            Features::resetPasswords(),
            Features::updateProfileInformation(),
            Features::updatePasswords(),
            Features::twoFactorAuthentication([
                'confirm' => false,
                'confirmPassword' => self::passwordRequired(),
                'window' => 10,
            ]),
        ];
    }

    public static function usesAuthenticator(): bool
    {
        return false;
    }

    public static function getLoginFormView(): string
    {
        return 'auth.login-otp';
    }

    public function setupViews(): void
    {
        // Setup authentication based on environment configuration
        if (!self::passwordRequired()) {
            self::setupAuthentication();
        }

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

        Fortify::twoFactorChallengeView(static function () {
            return view('auth.two-factor-challenge', [
                'uses_authenticator' => self::usesAuthenticator(),
            ]);
        });
    }

    private static function setupAuthentication(): void
    {
        app()->bind(FortifyLoginRequest::class, PasswordlessLoginRequest::class);

        Fortify::authenticateUsing(function (Request $request) {
            /** @var ?User $user */
            $user = User::query()->getByEmail($request->email)->first();
            if (!$user) {
                return null;
            }

            if (!$user->two_factor_secret) {
                Log::debug(sprintf("User %s has no two-factor secret set", $user->id));
                throw AccountConfigurationException::missingTwoFactorSecret();
            }

            return $user;
        });
    }
}
