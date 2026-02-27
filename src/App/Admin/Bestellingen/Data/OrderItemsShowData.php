<?php

namespace App\Admin\Bestellingen\Data;

use Domain\Bestellingen\Models\OrderItems;

readonly class OrderItemsShowData implements \JsonSerializable
{
    public function __construct(
        private OrderItems $orderItems
    ) {}

    /**
     * @inheritDoc
     *
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
