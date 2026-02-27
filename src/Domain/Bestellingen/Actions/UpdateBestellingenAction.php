<?php

namespace Domain\Bestellingen\Actions;

use Domain\Bestellingen\DataTransferObjects\BestellingUpsertData;
use Domain\Bestellingen\Models\Bestellingen;

class UpdateBestellingenAction
{
    // Update bestelling.
    public function execute(
        Bestellingen           $bestellingen,
        BestellingUpsertData $bestellingenData,
    ): Bestellingen
    {
        $data = $bestellingenData->toArray();

        $bestellingen->update($data);

        return $bestellingen;
    }
}
