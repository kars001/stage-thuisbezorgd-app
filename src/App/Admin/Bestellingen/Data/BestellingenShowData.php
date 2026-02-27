<?php

namespace App\Admin\Bestellingen\Data;

use Domain\Bestellingen\Models\Bestellingen;

readonly class BestellingenShowData  implements \JsonSerializable
{
    public function __construct(
        private Bestellingen $bestellingen
    ) {}

    /**
     * @inheritDoc
     *
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
