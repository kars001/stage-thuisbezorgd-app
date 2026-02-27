<?php

namespace App\Admin\Bestellingen\Responses;

use App\Admin\Bestellingen\Data\BestellingenShowData;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

readonly class BestellingenUpdateResponse implements Responsable
{
    public function __construct(
        private Bestellingen $bestellingen
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => new BestellingenShowData($this->bestellingen),
            'message' => 'Bestelling is succesvol geupdate.',
        ], 201);
    }
}
