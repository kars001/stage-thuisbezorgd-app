<?php

namespace Domain\Producten\Actions;

use Domain\Producten\DataTransferObjects\VariantenUpsertData;
use Domain\Producten\Models\Varianten;

class UpdateVariantenAction
{
    public function execute(
        Varianten           $varianten,
        VariantenUpsertData $variantenData,
    ): Varianten
    {
        $data = $variantenData->toArray();

        $varianten->update($data);

        return $varianten;
    }
}
