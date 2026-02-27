<?php

namespace Domain\Producten\Actions;

use Domain\Producten\DataTransferObjects\ProductenUpsertData;
use Domain\Producten\Models\Producten;

class CreateProductenAction
{
    // Maak een nieuw product aan.
    public function execute(
        ProductenUpsertData $productenData,
    ): Producten
    {
        // Maak product aan.
        $producten = new Producten([
            'restaurant_id' => $productenData->restaurant_id,
            'naam' => $productenData->naam,
            'beschrijving' => $productenData->beschrijving,
            'prijs' => $productenData->prijs,
        ]);

        $producten->save();

        // Synchroniseer varianten, categorieën en allergieën met de producten.
        $producten->varianten()->sync($productenData->varianten ?? []);
        $producten->categorieen()->sync($productenData->categorie ?? []);
        $producten->allergieen()->sync($productenData->allergieen ?? []);

        return $producten;
    }
}
