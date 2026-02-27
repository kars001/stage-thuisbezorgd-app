<?php

namespace Domain\Producten\QueryBuilders;

use Domain\Producten\Models\Producten;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Producten>
 */
class ProductenQueryBuilder extends Builder
{
    // Haal de gegevens van een specifiek product op
    public function getProductPrijs(int $productenId): self
    {
        return $this->whereKey($productenId);
    }
}
