<?php

namespace Domain\Bestellingen\Actions;

use Domain\Bestellingen\DataTransferObjects\OrderItemsUpsertData;
use Domain\Bestellingen\Models\OrderItems;
use Domain\Producten\Actions\GetProductExtraPrijsAction;
use Domain\Producten\Models\Producten;
use Domain\Producten\Models\Varianten;

class CreateOrderItemsAction
{
    // Link een product met variant aan bestelling.
    public function execute(
        OrderItemsUpsertData $orderItemData,
        GetProductExtraPrijsAction $getProductExtraPrijsAction,
    ): OrderItems
    {
        // Haal product prijs op.
        $productPrijs = Producten::query()->getProductPrijs($orderItemData->producten_id)->value('prijs');
        $productenExtraPrijs = $getProductExtraPrijsAction->execute($orderItemData->producten_id, $orderItemData->varianten_id);

        // Bereken eindprijs.
        $eindPrijs = (float) $productPrijs + $productenExtraPrijs;

        // Maak nieuwe order item.
        $orderItem = new OrderItems([
            'prijs' => $eindPrijs,
            'aantal' => $orderItemData->aantal,
            'bestellingen_id' => $orderItemData->bestellingen_id,
            'producten_id' => $orderItemData->producten_id,
            'varianten_id' => $orderItemData->varianten_id,
        ]);

        $orderItem->save();

        return $orderItem;
    }
}
