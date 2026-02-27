<?php

namespace App\Admin\Bestellingen\Responses;

use App\Admin\Bestellingen\Data\OrderItemsShowData;
use Domain\Bestellingen\Models\OrderItems;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

readonly class OrderItemsStoreResponse implements Responsable
{
    public function __construct(
        private OrderItems $orderItems
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => new OrderItemsShowData($this->orderItems),
            'message' => 'Order item succesvol aangemaakt.',
        ], 201);
    }
}
