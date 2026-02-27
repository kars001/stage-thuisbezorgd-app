<?php

namespace App\Admin\Bestellingen\Responses;

use App\Admin\Bestellingen\Data\BestellingenShowData;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

// Dit is de response voor de lijst met bestellingen
readonly class BestellingenIndexResponse implements Responsable
{
    // Hier slaat ie de lijst met bestellingen op
    /**
     * @param Collection<int, Bestellingen> $bestellingen
     */
    public function __construct(
        private Collection $bestellingen
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->bestellingen->map(fn (Bestellingen $bestelling) => new BestellingenShowData($bestelling)),
            'message' => 'Bestellingen zijn succesvol opgehaald.',
        ], 200);
    }
}
