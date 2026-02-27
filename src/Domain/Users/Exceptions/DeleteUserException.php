<?php

namespace Domain\Users\Exceptions;

class DeleteUserException extends UserException
{
    public function __construct(string $message = 'Unable to delete user', int $code = 0)
    {
        parent::__construct($message, 400, $code);
    }
}
