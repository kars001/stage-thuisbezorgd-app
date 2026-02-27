<?php

namespace Support\Authentication\Actions;

use Domain\Users\Models\User;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;

class GenerateOtpCodeForSecretAction
{
    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function execute(User $user): string
    {
        $secret = decrypt($user->two_factor_secret);
        return app(Google2Fa::class)->getCurrentOtp($secret);
    }
}
