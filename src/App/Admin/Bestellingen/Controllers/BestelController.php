<?php

namespace App\Admin\Bestellingen\Controllers;

use App\Admin\Bestellingen\Requests\StoreBestellingenRequest;
use App\Admin\Bestellingen\Responses\BestellingenUpdateResponse;
use App\Admin\Bestellingen\Responses\BestellingenIndexResponse;
use Domain\Bestellingen\Actions\ConfirmBestellingenAction;
use Domain\Bestellingen\Actions\CreateBestellingenAction;
use Domain\Bestellingen\DataTransferObjects\BestellingUpsertData;
use Domain\Bestellingen\Exceptions\RestaurantClosedException;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Http\JsonResponse;
use App\Admin\Bestellingen\Responses\BestellingenStoreResponse;
use Spatie\QueryBuilder\QueryBuilder;

class BestelController
{
    /**
     * @return BestellingenIndexResponse|JsonResponse
     */
    public function index(): BestellingenIndexResponse|JsonResponse
    {
        try {
            $bestellingen = QueryBuilder::for(Bestellingen::class)
                ->allowedFilters('status')
                ->get();

            return new BestellingenIndexResponse($bestellingen);
        } catch (RestaurantClosedException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(StoreBestellingenRequest $request, CreateBestellingenAction $action): BestellingenStoreResponse|JsonResponse
    {
        try {
            $bestellingenData = BestellingUpsertData::fromRequest($request->validated());
            $bestellingen = $action->execute($bestellingenData);

            return new BestellingenStoreResponse($bestellingen);
        } catch (RestaurantClosedException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Bestellingen $bestellingen, ConfirmBestellingenAction $action): BestellingenUpdateResponse|JsonResponse
    {
        try {
            $bestelling = $action->execute($bestellingen);

            return new BestellingenUpdateResponse($bestelling);
        } catch (RestaurantClosedException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
