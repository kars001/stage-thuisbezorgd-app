<?php

namespace Domain\Producten\Actions;

use Domain\Producten\Models\Producten;

class GetProductExtraPrijsAction
{
    // Haal extra prijs op.
    public function execute(int $productenId, int $variantenId): float
    {
        return Producten::query()
            ->whereKey($productenId)
            ->firstOrFail()
            ->varianten()
            ->where('variant_id', $variantenId)
            ->firstOrFail()
            ->pivot
            ->getAttribute('extra_prijs');
    }
}
