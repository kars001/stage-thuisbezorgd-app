<?php

namespace App\Admin\Bestellingen\Responses;

use App\Admin\Bestellingen\Data\BestellingenShowData;
use Cowsayphp\Cow;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

// Dit is de response voor een aangepaste bestelling
readonly class BestellingenUpdateResponse implements Responsable
{
    // Hier slaat ie de aangepaste bestelling op
    public function __construct(
        private Bestellingen $bestellingen
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => new BestellingenShowData($this->bestellingen),
            'message' => '<pre>'.Cow::say("Bestelling is succesvol geupdate.").'</pre>',
        ], 201);
    }
}
