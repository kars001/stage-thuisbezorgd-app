<?php

namespace Domain\Bestellingen\QueryBuilders;

use Domain\Bestellingen\Enums\BestellingStatusEnum;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @extends Builder<Bestellingen>
 */
class BestellingenQueryBuilder extends Builder
{
    public function getBestellingenForCancellation(): self
    {
        /** @var BestellingenQueryBuilder $trashedQuery */
        $trashedQuery = $this->withTrashed();
        return $trashedQuery
            ->where('status', '=', BestellingStatusEnum::Gemaakt->value)
            ->where('updated_at', '<=', Carbon::now()->subMinutes(15));
    }

    public function getBestellingen(int $bestellingId): self
    {
        return $this->whereKey($bestellingId);
    }
}
