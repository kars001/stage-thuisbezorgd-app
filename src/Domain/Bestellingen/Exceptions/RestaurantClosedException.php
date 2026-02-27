<?php

namespace Domain\Bestellingen\Exceptions;

class RestaurantClosedException extends \DomainException
{
    // Maak een nieuwe exception aan voor het restaurant gesloten.
    public function __construct(?\Throwable $previous = null)
    {
        $message = 'Bestelling niet aangemaakt, restaurant is gesloten.';
        $code = 422;
        parent::__construct($message, $code, $previous);
    }
}
