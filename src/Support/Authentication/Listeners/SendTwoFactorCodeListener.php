<?php

namespace Support\Authentication\Listeners;

use App\Admin\Notifications\Send2FAasOTP;
use Domain\Users\Models\User;
use Laravel\Fortify\Events\TwoFactorAuthenticationChallenged;
use Laravel\Fortify\Events\TwoFactorAuthenticationEnabled;
use Laravel\Fortify\TwoFactorAuthenticatable;

class SendTwoFactorCodeListener
{
    /**
     * Handle the event.
     */
    public function handle(TwoFactorAuthenticationChallenged|TwoFactorAuthenticationEnabled $event): void {
        /** @var User $user */
        $user = $event->user;
        if (
            in_array(TwoFactorAuthenticatable::class, class_uses_recursive($user))
            && $user->two_factor_secret
        ) {
            $user->notify(app(Send2FAasOTP::class));
        }
    }
}
