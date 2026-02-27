<?php

namespace App\Admin\Producten\Data;

use Domain\Producten\Models\Producten;

// Deze klasse bereidt de productgegevens voor op JSON-serialisatie
readonly class ProductenShowData  implements \JsonSerializable
{
    public function __construct(
        private Producten $producten
    ) {}

    // Zet de productobject-gegevens om naar een array voor de API-output
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->producten->id,
            'naam' => $this->producten->naam,
            'beschrijving' => $this->producten->beschrijving,
            'prijs' => $this->producten->prijs,
            'restaurant_id' => $this->producten->restaurant_id,
        ];
    }
}
