<?php

namespace App\Admin\Bestellingen\Data;

use Domain\Bestellingen\Models\Bestellingen;

// Deze klasse bereidt de bestelgegevens voor op JSON-serialisatie
readonly class BestellingenShowData  implements \JsonSerializable
{
    public function __construct(
        private Bestellingen $bestellingen
    ) {}

    // Zet de bestelobject-gegevens om naar een array voor de API-output
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->bestellingen->id,
            'status' => $this->bestellingen->status,
            'klanten_id' => $this->bestellingen->klanten_id,
            'restaurant_id' => $this->bestellingen->restaurant_id,
            'verzendkosten' => $this->bestellingen->verzendkosten,
            'totaalprijs' => $this->bestellingen->totaalprijs,
        ];
    }
}
