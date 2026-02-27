<?php

namespace Domain\Users\Exceptions;

class CreateUserException extends UserException
{
    public function __construct(string $message = 'Unable to create user', int $code = 0)
    {
        parent::__construct($message, 400, $code);
    }
}
