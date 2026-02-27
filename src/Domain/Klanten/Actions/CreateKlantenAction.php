<?php

namespace Domain\Klanten\Actions;

use Domain\Klanten\DataTransferObjects\KlantenUpsertData;
use Domain\Klanten\Exceptions\KlantenException;
use Domain\Klanten\Models\Klanten;

class CreateKlantenAction
{
    // Maak een nieuwe klant aan.
    public function execute(
        KlantenUpsertData $klantData,
    ): Klanten
    {
        // Controleer of de klant al bestaat.
        if (Klanten::query()->findKlantenWithEmail($klantData->email)->exists()) {
            throw new KlantenException();
        }

        // Maak nieuwe klant.
        $klant = new Klanten([
            'voornaam' => $klantData->voornaam,
            'achternaam' => $klantData->achternaam,
            'adres' => $klantData->adres,
            'email' => $klantData->email,
            'telefoonnummer' => $klantData->telefoonnummer,
        ]);

        $klant->save();

        return $klant;
    }
}
