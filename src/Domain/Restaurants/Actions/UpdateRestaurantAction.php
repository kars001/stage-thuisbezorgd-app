<?php

namespace Domain\Restaurants\Actions;

use Domain\Restaurants\DataTransferObjects\RestaurantUpsertData;
use Domain\Restaurants\Models\Restaurant;

class UpdateRestaurantAction
{
    public function execute(
        Restaurant $restaurant,
        RestaurantUpsertData $restaurantData,
    ): Restaurant {
        $data = $restaurantData->toArray();

        $restaurant->update($data);

        return $restaurant;
    }
}
