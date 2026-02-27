<?php

namespace App\Admin\Bestellingen\Responses;

use App\Admin\Bestellingen\Data\OrderItemsShowData;
use Domain\Bestellingen\Models\OrderItems;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

// Dit is de response voor een nieuw besteld product
readonly class OrderItemsStoreResponse implements Responsable
{
    // Hier slaat ie het nieuwe product op
    public function __construct(
        private OrderItems $orderItems
    ) {
    }

    // Zet de gegevens om naar een JSON antwoord
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => new OrderItemsShowData($this->orderItems),
            'message' => 'Order item succesvol aangemaakt.',
        ], 201);
    }
}
