<?php

namespace Domain\Restaurants\Actions;

use Domain\Restaurants\Models\Restaurant;
use Domain\Restaurants\DataTransferObjects\RestaurantUpsertData;

class CreateRestaurantAction
{
    // Maak een nieuw restaurant aan.
    public function execute(
        RestaurantUpsertData $restaurantData,
    ): Restaurant
    {
        $restaurant = new Restaurant([
            'naam' => $restaurantData->naam,
            'beschrijving' => $restaurantData->beschrijving,
            'adres' => $restaurantData->adres,
            'bezorggebied' => $restaurantData->bezorggebied,
            'open_en_sluit_tijden' => $restaurantData->open_en_sluit_tijden,
            'minimaal_bestelbedrag' => $restaurantData->minimaal_bestelbedrag,
            'bezorgkosten' => $restaurantData->bezorgkosten,
            'status' => $restaurantData->status,
            'logo_url' => $restaurantData->logo_url,
            'header_url' => $restaurantData->header_url,
        ]);

        $restaurant->save();

        return $restaurant;
    }
}
