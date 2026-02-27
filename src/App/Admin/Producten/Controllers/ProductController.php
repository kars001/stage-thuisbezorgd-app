<?php

namespace App\Admin\Producten\Controllers;

use App\Admin\Producten\Responses\ProductenIndexResponse;
use Domain\Producten\Models\Producten;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController
{
     // Toon een lijst met alle producten.
    public function index(): ProductenIndexResponse|JsonResponse
    {
        try {
            $producten = QueryBuilder::for(Producten::class)
                ->get();

            return new ProductenIndexResponse($producten);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
