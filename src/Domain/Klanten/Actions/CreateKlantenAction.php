<?php

namespace Domain\Klanten\Actions;

use Domain\Klanten\DataTransferObjects\KlantenUpsertData;
use Domain\Klanten\Exceptions\KlantenException;
use Domain\Klanten\Models\Klanten;

class CreateKlantenAction
{
    public function execute(
        KlantenUpsertData $klantData,
    ): Klanten
    {
        if (Klanten::query()->findKlantenWithEmail($klantData->email)->exists()) {
            throw new KlantenException();
        }

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
