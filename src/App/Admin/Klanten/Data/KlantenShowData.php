<?php

namespace App\Admin\Klanten\Data;

use Domain\Klanten\Models\Klanten;

readonly class KlantenShowData implements \JsonSerializable
{
    public function __construct(
        private Klanten $klanten
    ) {}

    /**
     * @inheritDoc
     *
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
