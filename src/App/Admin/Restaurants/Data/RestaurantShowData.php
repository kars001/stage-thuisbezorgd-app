<?php

namespace App\Admin\Restaurants\Data;

use Domain\Restaurants\Models\Restaurant;

readonly class RestaurantShowData implements \JsonSerializable
{
    public function __construct(
        private Restaurant $restaurant
    ) {}

    /**
     * @inheritDoc
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->restaurant->id,
            'naam' => $this->restaurant->naam,
            'beschrijving' => $this->restaurant->beschrijving,
            'adres' => $this->restaurant->adres,
            'bezorggebied' => $this->restaurant->bezorggebied,
            'open_en_sluit_tijden' => $this->restaurant->open_en_sluit_tijden,
            'minimaal_bestelbedrag' => $this->restaurant->minimaal_bestelbedrag,
            'bezorgkosten' => $this->restaurant->bezorgkosten,
            'status' => $this->restaurant->status,
            'logo_url' => $this->restaurant->logo_url,
            'header_url' => $this->restaurant->header_url,
        ];
    }
}
