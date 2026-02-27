<?php

namespace App\Admin\Producten\Data;

use Domain\Producten\Models\Producten;

readonly class ProductenShowData  implements \JsonSerializable
{
    public function __construct(
        private Producten $producten
    ) {}

    /**
     * @inheritDoc
     *
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
