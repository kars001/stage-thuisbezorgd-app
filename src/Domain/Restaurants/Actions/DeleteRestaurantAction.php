<?php

namespace Domain\Restaurants\Actions;

use Domain\Restaurants\Models\Restaurant;

class DeleteRestaurantAction
{
    // Verwijder restaurant files.
    public function __construct(
        private readonly DeleteRestaurantFilesAction $DeleteRestaurantFilesAction
    ) {}

    // Verwijder restaurant.
    public function execute(
        Restaurant $restaurant,
    ): Restaurant {
        $this->DeleteRestaurantFilesAction->execute($restaurant);
        $restaurant->forceDelete();

        return $restaurant;
    }
}
