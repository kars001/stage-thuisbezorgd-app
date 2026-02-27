<?php

namespace Domain\Klanten\Exceptions;

class KlantenException extends \DomainException
{
    // Maak een nieuwe exception aan voor het bestaande klant.
    public function __construct(?\Throwable $previous = null)
    {
        $message = 'Klant bestaat al.';
        $code = 422;
        parent::__construct($message, $code, $previous);
    }
}
