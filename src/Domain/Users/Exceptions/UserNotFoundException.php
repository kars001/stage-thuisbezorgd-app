<?php

namespace Domain\Users\Exceptions;

class UserNotFoundException extends UserException
{
    public function __construct(string $message = 'User not found', int $code = 0)
    {
        parent::__construct($message, 404, $code);
    }
}
