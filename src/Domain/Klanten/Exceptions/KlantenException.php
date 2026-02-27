<?php

namespace Domain\Klanten\Exceptions;

class KlantenException extends \DomainException
{
    public function __construct(?\Throwable $previous = null)
    {
        $message = 'Klant bestaat al.';
        $code = 422;
        parent::__construct($message, $code, $previous);
    }
}
