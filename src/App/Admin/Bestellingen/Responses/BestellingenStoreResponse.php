<?php

namespace App\Admin\Bestellingen\Responses;

use App\Admin\Bestellingen\Data\BestellingenShowData;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

// Dit is de response voor een nieuwe bestelling
readonly class BestellingenStoreResponse implements Responsable
{
    // Hier slaat ie de nieuwe bestelling op
    public function __construct(
        private Bestellingen $bestellingen
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => new BestellingenShowData($this->bestellingen),
            'message' => 'Bestelling is succesvol aangemaakt.',
        ], 201);
    }
}
