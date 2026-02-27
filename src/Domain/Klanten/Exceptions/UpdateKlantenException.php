<?php

namespace Domain\Klanten\Exceptions;

class UpdateKlantenException extends \DomainException
{
    public function __construct(?\Throwable $previous = null)
    {
        $message = 'Er is iets mis gegaan bij het updaten van de klant.';
        $code = 422;
        parent::__construct($message, $code, $previous);
    }
}
