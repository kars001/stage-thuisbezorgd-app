<?php

namespace App\Admin\Producten\Responses;

use App\Admin\Producten\Data\ProductenShowData;
use Domain\Producten\Models\Producten;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

readonly class ProductenIndexResponse implements Responsable
{
    /**
     * @param Collection<int, Producten> $producten
     */
    public function __construct(
        private Collection $producten
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->producten->map(fn (Producten $product) => new ProductenShowData($product)),
            'message' => 'Producten zijn succesvol opgehaald.',
        ], 200);
    }
}
