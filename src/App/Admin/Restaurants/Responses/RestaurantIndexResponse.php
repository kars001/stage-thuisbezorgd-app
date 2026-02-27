<?php

namespace App\Admin\Restaurants\Responses;

use App\Admin\Restaurants\Data\RestaurantShowData;
use Domain\Restaurants\Models\Restaurant;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

// Dit is de response voor de lijst met restaurants
readonly class RestaurantIndexResponse implements Responsable
{
    // Hier slaat ie de lijst met restaurants op
    /**
     * @param Collection<int, Restaurant> $restaurant
     */
    public function __construct(
        private Collection $restaurant
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->restaurant->map(fn (Restaurant $restaurant) => new RestaurantShowData($restaurant)),
            'message' => 'Restauranten zijn succesvol opgehaald.',
        ], 200);
    }
}
