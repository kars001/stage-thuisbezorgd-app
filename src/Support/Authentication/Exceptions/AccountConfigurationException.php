<?php

namespace Support\Authentication\Exceptions;

use Illuminate\Validation\ValidationException;

class AccountConfigurationException extends ValidationException
{
    public static function missingTwoFactorSecret(): self
    {
        return static::withMessages([
            'email' => ['It appears that there is something wrong. Try again or contact the administrator if the problem persists.']
        ]);
    }
}
