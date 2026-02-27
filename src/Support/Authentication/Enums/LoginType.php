<?php

namespace Support\Authentication\Enums;

enum LoginType: string
{
    case DEFAULT = 'default';
    case OTP = 'otp';
}
