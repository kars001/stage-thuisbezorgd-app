<?php

namespace Domain\Bestellingen\QueryBuilders;

use Domain\Bestellingen\Models\OrderItems;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<OrderItems>
 */
class OrderItemsQueryBuilder extends Builder
{
    // Haal alle artikelen van een specifieke bestelling op
    public function getBestellingenOrderItems(int $bestellingId): self
    {
        return $this->where('bestellingen_id', $bestellingId);
    }
}
