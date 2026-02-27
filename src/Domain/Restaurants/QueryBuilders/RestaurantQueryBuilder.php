<?php

namespace Domain\Restaurants\QueryBuilders;

use Domain\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * @extends Builder<Restaurant>
 */
class RestaurantQueryBuilder extends Builder
{
    // Haal alleen verwijderde restaurants op die ouder zijn dan een aantal dagen
    public function onlyDeletedOlderThan(int $days): self
    {
        /** @var RestaurantQueryBuilder $trashedQuery */
        $trashedQuery = $this->withTrashed();
        return $trashedQuery->where('deleted_at', '<=', Carbon::now()->subDays($days));
    }
}
