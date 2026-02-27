<?php

namespace App\Admin\Bestellingen\Controllers;

use App\Admin\Bestellingen\Requests\StoreOrderItemsRequest;
use Domain\Bestellingen\Actions\CreateOrderItemsAction;
use Domain\Producten\Actions\GetProductExtraPrijsAction;
use Domain\Bestellingen\DataTransferObjects\OrderItemsUpsertData;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Admin\Bestellingen\Responses\OrderItemsStoreResponse;

class OrderItemsController
{
    // Sla een nieuw product op en link hem aan een bestelling.
    public function store(
        StoreOrderItemsRequest $request,
        CreateOrderItemsAction $action,
        GetProductExtraPrijsAction $getProductExtraPrijsAction
    ): Responsable|JsonResponse
    {
        try {
            $orderItemData = OrderItemsUpsertData::fromRequest($request->validated());
            $orderItem = $action->execute($orderItemData, $getProductExtraPrijsAction);

            return new OrderItemsStoreResponse($orderItem);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
