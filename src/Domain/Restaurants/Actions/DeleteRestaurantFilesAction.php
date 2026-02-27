<?php

namespace Domain\Restaurants\Actions;

use Domain\Restaurants\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class DeleteRestaurantFilesAction
{
    public function execute(Restaurant $restaurant): void
    {
        if ($restaurant->logo_url) {
            Storage::disk('public')->delete($restaurant->logo_url);
        }

        if ($restaurant->header_url) {
            Storage::disk('public')->delete($restaurant->header_url);
        }
    }
}
