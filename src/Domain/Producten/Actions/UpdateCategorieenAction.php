<?php

namespace Domain\Producten\Actions;

use Domain\Producten\DataTransferObjects\CategorieenUpsertData;
use Domain\Producten\Models\Categorie;

class UpdateCategorieenAction
{
    // Update categorie.
    public function execute(
        Categorie           $categorieen,
        CategorieenUpsertData $categorieenData,
    ): Categorie
    {
        $data = $categorieenData->toArray();

        $categorieen->update($data);

        return $categorieen;
    }
}
