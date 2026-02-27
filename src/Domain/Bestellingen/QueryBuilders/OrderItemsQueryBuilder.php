<?php

namespace Domain\Bestellingen\QueryBuilders;

use Domain\Bestellingen\Models\OrderItems;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<OrderItems>
 */
class OrderItemsQueryBuilder extends Builder
{
    public function getBestellingenOrderItems(int $bestellingId): self
    {
        return $this->where('bestellingen_id', $bestellingId);
    }
}
