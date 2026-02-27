<?php

namespace Domain\Producten\Actions;

use Domain\Producten\DataTransferObjects\ProductenUpsertData;
use Domain\Producten\Models\Producten;

class UpdateProductenAction
{
    // Update product.
    public function execute(
        Producten $producten,
        ProductenUpsertData $productenData,
    ): Producten {
        $producten->update([
            'restaurant_id' => $productenData->restaurant_id,
            'naam' => $productenData->naam,
            'beschrijving' => $productenData->beschrijving,
            'prijs' => $productenData->prijs,
        ]);

        // Bekijkt of varianten zijn meegegeven.
        if ($productenData->varianten !== null) {
            $producten->varianten()->sync($productenData->varianten);
        }

        // Bekijkt of categorie is meegegeven.
        if ($productenData->categorie !== null) {
            $producten->categorieen()->sync($productenData->categorie);
        }

        // Bekijkt of allergieen zijn meegegeven.
        if ($productenData->allergieen !== null) {
            $producten->allergieen()->sync($productenData->allergieen);
        }

        return $producten;
    }
}
