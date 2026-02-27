<?php

namespace Support\Authentication\LoginConfiguration;

use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;
use Laravel\Fortify\Fortify;
use Support\Authentication\Actions\Fortify\CreateNewUser;
use Support\Authentication\Actions\Fortify\ResetUserPassword;
use Support\Authentication\Actions\Fortify\UpdateUserPassword;
use Support\Authentication\Actions\Fortify\UpdateUserProfileInformation;
use Support\Authentication\Responses\CustomLoginResponse;

abstract class AbstractLoginConfiguration
{
    public static function passwordRequired(): bool
    {
        return config('auth.password_required', true);
    }

    public static function ssoEnabled(): bool
    {
        return config('auth.sso_enabled', false);
    }

    abstract public static function usesAuthenticator(): bool;

    /**
     * @return array<int, mixed>
     */
    abstract public function getFeatures(): array;

    abstract public static function getLoginFormView(): string;

    abstract public function setupViews(): void;

    public function loginResponse(): LoginResponse
    {
        return new CustomLoginResponse();
    }

    public function configureLogin(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(static function () {
            return view('auth.login', [
                'login_form_view' => static::getLoginFormView(),
                'password_required' => static::passwordRequired(),
                'sso_enabled' => static::ssoEnabled(),
            ]);
        });

        app()->instance(LoginResponse::class, $this->loginResponse());
        app()->instance(TwoFactorLoginResponse::class, $this->loginResponse());

        $this->setupViews();
    }
}
