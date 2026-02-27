<?php

namespace App\Admin\Klanten\Responses;

use App\Admin\Klanten\Data\KlantenShowData;
use Domain\Klanten\Models\Klanten;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

readonly class KlantenStoreResponse implements Responsable
{
    public function __construct(
        private Klanten $klanten
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => new KlantenShowData($this->klanten),
            'message' => 'Klant is succesvol aangemaakt.',
        ], 201);
    }
}
