<?php

namespace Domain\Users\Exceptions;

class UpdateUserException extends UserException
{
    public function __construct(string $message = 'Unable to update user', int $code = 0)
    {
        parent::__construct($message, 400, $code);
    }
}
