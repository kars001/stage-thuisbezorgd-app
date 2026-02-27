<?php

namespace Domain\Restaurants\Actions;

use Domain\Restaurants\Models\Restaurant;

class DeleteRestaurantAction
{
    public function __construct(
        private readonly DeleteRestaurantFilesAction $DeleteRestaurantFilesAction
    ) {}

    public function execute(
        Restaurant $restaurant,
    ): Restaurant {
        $this->DeleteRestaurantFilesAction->execute($restaurant);
        $restaurant->forceDelete();

        return $restaurant;
    }
}
