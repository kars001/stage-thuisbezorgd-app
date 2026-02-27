<?php

namespace Domain\Bestellingen\Actions;

use Domain\Bestellingen\Enums\BestellingStatusEnum;
use Domain\Bestellingen\Models\Bestellingen;

class CancelBestellingenAction
{
    public function execute(
        Bestellingen $bestellingen,
    ): Bestellingen {
        $bestellingen->update([
            'status' => BestellingStatusEnum::Geannuleerd,
        ]);

        return $bestellingen;
    }
}
