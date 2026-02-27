<?php

namespace Domain\Bestellingen\Actions;

use Domain\Bestellingen\Enums\BestellingStatusEnum;
use Domain\Bestellingen\Exceptions\MinimaalBestelBedragException;
use Domain\Bestellingen\Models\Bestellingen;
use Domain\Bestellingen\Models\OrderItems;
use Domain\Restaurants\Models\Restaurant;

class ConfirmBestellingenAction
{
    public function execute(
        Bestellingen $bestellingen,
    ): Bestellingen {
        $verzendKosten = Bestellingen::query()->getBestellingen($bestellingen->id)->value('verzendkosten') ?? 0;
        $minimaalBestelBedrag = Restaurant::query()->whereKey($bestellingen->restaurant_id)->value('minimaal_bestelbedrag') ?? 0;
        $orderItems = OrderItems::query()->getBestellingenOrderItems($bestellingen->id)->get();

        $orderItemsPrijs = $orderItems->sum(fn($item) => $item->prijs * $item->aantal);
        $totaalPrijs = (float) $orderItemsPrijs + (float) $verzendKosten;

        if ($totaalPrijs < $minimaalBestelBedrag) {
            throw new MinimaalBestelBedragException($minimaalBestelBedrag);
        }

        $bestellingen->update([
            'status' => BestellingStatusEnum::Bevestigd,
            'totaalprijs' => $totaalPrijs,
        ]);

        return $bestellingen;
    }
}
