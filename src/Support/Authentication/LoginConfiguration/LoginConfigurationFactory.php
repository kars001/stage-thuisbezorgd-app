<?php

namespace Support\Authentication\LoginConfiguration;

use Support\Authentication\Enums\LoginType;

class LoginConfigurationFactory
{
    public static function getImplementation(): AbstractLoginConfiguration
    {
        $loginType = config('auth.login_type', LoginType::DEFAULT->value);
        $loginType = is_string($loginType) ? $loginType : $loginType->value;

        return match ($loginType) {
            LoginType::OTP->value => new OtpLoginConfiguration(),
            LoginType::DEFAULT->value => new DefaultLoginConfiguration(),
            default => throw new \InvalidArgumentException("Unknown login type: {$loginType}"),
        };
    }
}
