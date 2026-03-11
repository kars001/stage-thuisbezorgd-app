<?php

namespace App\Admin\Klanten\Responses;

use App\Admin\Klanten\Data\KlantenShowData;
use Domain\Klanten\Models\Klanten;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

// Dit is de response voor de lijst met klanten
readonly class KlantenIndexResponse implements Responsable
{
    // Hier haalt ie de lijst met klanten op
    /**
     * @param Collection<int, Klanten> $klanten
     */
    public function __construct(
        private Collection $klanten
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->klanten->map(fn (Klanten $klanten) => new KlantenShowData($klanten)),
            'message' => 'Klanten zijn succesvol opgehaald.',
        ], 200);
    }
}
