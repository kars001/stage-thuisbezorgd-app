<?php

namespace App\Admin\Bestellingen\Responses;

use App\Admin\Bestellingen\Data\BestellingenShowData;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

readonly class BestellingenIndexResponse implements Responsable
{
    /**
     * @param Collection<int, Bestellingen> $bestellingen
     */
    public function __construct(
        private Collection $bestellingen
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->bestellingen->map(fn (Bestellingen $bestelling) => new BestellingenShowData($bestelling)),
            'message' => 'Bestellingen zijn succesvol opgehaald.',
        ], 200);
    }
}
