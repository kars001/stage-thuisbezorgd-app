<?php

namespace App\Admin\Restaurants\Responses;

use App\Admin\Restaurants\Data\RestaurantShowData;
use Domain\Restaurants\Models\Restaurant;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

readonly class RestaurantIndexResponse implements Responsable
{
    /**
     * @param Collection<int, Restaurant> $restaurant
     */
    public function __construct(
        private Collection $restaurant
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->restaurant->map(fn (Restaurant $restaurant) => new RestaurantShowData($restaurant)),
            'message' => 'Restauranten zijn succesvol opgehaald.',
        ], 200);
    }
}
