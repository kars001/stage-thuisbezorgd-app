<?php

namespace App\Admin\Producten\Responses;

use App\Admin\Producten\Data\ProductenShowData;
use Domain\Producten\Models\Producten;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

// Dit is de response voor de lijst met producten
readonly class ProductenIndexResponse implements Responsable
{
    // Hier slaat ie de lijst met producten op
    /**
     * @param Collection<int, Producten> $producten
     */
    public function __construct(
        private Collection $producten
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->producten->map(fn (Producten $product) => new ProductenShowData($product)),
            'message' => 'Producten zijn succesvol opgehaald.',
        ], 200);
    }
}
