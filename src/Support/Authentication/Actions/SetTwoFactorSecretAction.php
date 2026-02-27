<?php

namespace Support\Authentication\Actions;

use Domain\Users\Models\User;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

class SetTwoFactorSecretAction
{
    public function execute(User $user): void
    {
        /**  @var TwoFactorAuthenticationProvider $provider */
        $provider = app(TwoFactorAuthenticationProvider::class);
        if (!isset($user->two_factor_secret)) {
            $user->forceFill([
                'two_factor_secret' => encrypt($provider->generateSecretKey()),
            ]);
        }
    }
}
