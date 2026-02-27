<?php

namespace App\Admin\Restaurants\Controllers;

use Domain\Restaurants\Models\Restaurant;
use App\Admin\Restaurants\Responses\RestaurantIndexResponse;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class RestaurantController
{
     // Toon een lijst met alle restaurants.
    public function index(): RestaurantIndexResponse|JsonResponse
    {
        try {
            $restaurant = QueryBuilder::for(Restaurant::class)
                ->get();

            return new RestaurantIndexResponse($restaurant);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
