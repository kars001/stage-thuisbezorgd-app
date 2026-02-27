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
    public function execute(
        BestellingUpsertData $bestellingData,
    ): Bestellingen
    {
        $restaurant = Restaurant::query()->findOrFail($bestellingData->restaurant_id);
        $restaurantStatus = $restaurant->status;

        if ($restaurantStatus === RestaurantStatusEnum::Gesloten) {
            throw new RestaurantClosedException();
        }

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
