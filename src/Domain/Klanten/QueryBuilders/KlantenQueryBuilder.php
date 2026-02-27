<?php

namespace Domain\Klanten\QueryBuilders;

use Domain\Klanten\Models\Klanten;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Klanten>
 */
class KlantenQueryBuilder extends Builder
{
    public function findKlantenWithEmail(string $email): self
    {
        /** @var KlantenQueryBuilder $trashedQuery */
        $trashedQuery = $this->withTrashed();
        return $trashedQuery->where('email', $email);
    }
}
