<?php

namespace Domain\Users\Exceptions;

use Exception;
use Throwable;

class UserException extends Exception
{
    protected int $status;

    public function __construct(string $message = 'User error', int $status = 400, int $code = 0, ?Throwable $previous = null)
    {
        $this->status = $status;
        parent::__construct($message, $code, $previous);
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
