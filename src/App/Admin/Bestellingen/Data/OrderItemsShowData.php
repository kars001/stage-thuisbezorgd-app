<?php

namespace App\Admin\Bestellingen\Data;

use Domain\Bestellingen\Models\OrderItems;

// Deze klasse bereidt de orderitem-gegevens voor op JSON-serialisatie
readonly class OrderItemsShowData implements \JsonSerializable
{
    public function __construct(
        private OrderItems $orderItems
    ) {}

    // Zet de orderitemobject-gegevens om naar een array voor de API-output
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->orderItems->id,
            'prijs' => $this->orderItems->prijs,
            'aantal' => $this->orderItems->aantal,
            'bestellingen_id' => $this->orderItems->bestellingen_id,
            'producten_id' => $this->orderItems->producten_id,
            'varianten_id' => $this->orderItems->varianten_id,
        ];
    }
}
