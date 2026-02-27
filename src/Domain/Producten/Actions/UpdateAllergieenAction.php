<?php

namespace Domain\Producten\Actions;

use Domain\Producten\DataTransferObjects\AllergieenUpsertData;
use Domain\Producten\Models\Allergieen;

class UpdateAllergieenAction
{
    // Update allergie.
    public function execute(
        Allergieen           $allergieen,
        AllergieenUpsertData $allergieenData,
    ): Allergieen
    {
        $data = $allergieenData->toArray();

        $allergieen->update($data);

        return $allergieen;
    }
}
