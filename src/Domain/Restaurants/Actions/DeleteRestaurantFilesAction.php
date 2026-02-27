<?php

namespace Domain\Restaurants\Actions;

use Domain\Restaurants\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class DeleteRestaurantFilesAction
{
    // Verwijder restaurant files.
    public function execute(Restaurant $restaurant): void
    {
        // Bekijkt of logo bestaat zo ja verwijdert.
        if ($restaurant->logo_url) {
            Storage::disk('public')->delete($restaurant->logo_url);
        }

        // Bekijkt of header bestaat zo ja verwijdert.
        if ($restaurant->header_url) {
            Storage::disk('public')->delete($restaurant->header_url);
        }
    }
}
