<?php

namespace Domain\Producten\Actions;

use Domain\Producten\DataTransferObjects\ProductenUpsertData;
use Domain\Producten\Models\Producten;

class UpdateProductenAction
{
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

        if ($productenData->varianten !== null) {
            $producten->varianten()->sync($productenData->varianten);
        }

        if ($productenData->categorie !== null) {
            $producten->categorieen()->sync($productenData->categorie);
        }

        if ($productenData->allergieen !== null) {
            $producten->allergieen()->sync($productenData->allergieen);
        }

        return $producten;
    }
}
