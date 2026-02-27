<?php

namespace App\Admin\Klanten\Responses;

use App\Admin\Klanten\Data\KlantenShowData;
use Domain\Klanten\Models\Klanten;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

// Dit is de response voor een nieuwe klant
readonly class KlantenStoreResponse implements Responsable
{
    // Hier slaat ie de nieuwe klant op
    public function __construct(
        private Klanten $klanten
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => new KlantenShowData($this->klanten),
            'message' => 'Klant is succesvol aangemaakt.',
        ], 201);
    }
}
