<?php

namespace Domain\Klanten\Actions;

use Domain\Klanten\DataTransferObjects\KlantenUpdateData;
use Domain\Klanten\Models\Klanten;

class UpdateKlantenAction
{
    public function execute(
        Klanten           $klanten,
        KlantenUpdateData $klantData,
    ): Klanten
    {
         $data = $klantData->toArray();

        $klanten->update($data);

        return $klanten;
    }
}
