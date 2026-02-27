<?php

namespace Domain\Bestellingen\Exceptions;

class MinimaalBestelBedragException extends \DomainException
{
    // Maak een nieuwe exception aan voor het minimaal bestel bedrag.
    public function __construct(float $minimaalBestelBedrag, ?\Throwable $previous = null)
    {
        $message = 'Bestelling niet aangemaakt, minimale bestel bedrag is ' . $minimaalBestelBedrag . ' euro.';
        $code = 422;
        parent::__construct($message, $code, $previous);
    }
}
