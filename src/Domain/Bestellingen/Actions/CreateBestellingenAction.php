<?php

namespace Domain\Bestellingen\Actions;

use Domain\Bestellingen\DataTransferObjects\BestellingUpsertData;
use Domain\Bestellingen\Enums\BestellingStatusEnum;
use Domain\Bestellingen\Exceptions\RestaurantClosedException;
use Domain\Bestellingen\Models\Bestellingen;
use Domain\Restaurants\Enums\RestaurantStatusEnum;
use Domain\Restaurants\Models\Restaurant;

class CreateBestellingenAction
{
    // Maak een nieuwe bestelling.
    public function execute(
        BestellingUpsertData $bestellingData,
    ): Bestellingen
    {
        // Haal restaurant status op.
        $restaurant = Restaurant::query()->findOrFail($bestellingData->restaurant_id);
        $restaurantStatus = $restaurant->status;

        // Controleer of restaurant gesloten is.
        if ($restaurantStatus === RestaurantStatusEnum::Gesloten) {
            throw new RestaurantClosedException();
        }

        // Maak nieuwe bestelling.
        $bestelling = new Bestellingen([
            'status' => BestellingStatusEnum::Gemaakt,
            'klanten_id' => $bestellingData->klanten_id,
            'restaurant_id' => $bestellingData->restaurant_id,
            'verzendkosten' => $restaurant->bezorgkosten ?? 0,
        ]);

        $bestelling->save();

        return $bestelling;
    }
}
