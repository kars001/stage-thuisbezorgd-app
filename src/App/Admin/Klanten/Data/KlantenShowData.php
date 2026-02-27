<?php

namespace App\Admin\Klanten\Data;

use Domain\Klanten\Models\Klanten;

// Deze klasse bereidt de klantgegevens voor op JSON-serialisatie
readonly class KlantenShowData implements \JsonSerializable
{
    public function __construct(
        private Klanten $klanten
    ) {}

    // Zet de klantobject-gegevens om naar een array voor de API-output
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->klanten->id,
            'voornaam' => $this->klanten->voornaam,
            'achternaam' => $this->klanten->achternaam,
            'adres' => $this->klanten->adres,
            'email' => $this->klanten->email,
            'telefoonnummer' => $this->klanten->telefoonnummer,
        ];
    }
}
