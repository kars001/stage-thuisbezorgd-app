<?php

namespace App\Admin\Klanten\Controllers;

use App\Admin\Klanten\Requests\StoreKlantenRequest;
use App\Admin\Klanten\Requests\UpdateKlantenRequest;
use App\Admin\Klanten\Responses\KlantenStoreResponse;
use App\Admin\Klanten\Responses\KlantenUpdateResponse;
use Domain\Klanten\Actions\CreateKlantenAction;
use Domain\Klanten\Actions\UpdateKlantenAction;
use Domain\Klanten\DataTransferObjects\KlantenUpdateData;
use Domain\Klanten\DataTransferObjects\KlantenUpsertData;
use Domain\Klanten\Exceptions\KlantenException;
use Domain\Klanten\Exceptions\UpdateKlantenException;
use Domain\Klanten\Models\Klanten;
use Illuminate\Http\JsonResponse;

class KlantenController
{
     // Sla een nieuwe klant op.
    public function store(StoreKlantenRequest $request, CreateKlantenAction $action): KlantenStoreResponse|JsonResponse
    {
        try {
            $klantenData = KlantenUpsertData::fromRequest($request->validated());
            $klanten = $action->execute($klantenData);

            return new KlantenStoreResponse($klanten);
        } catch (KlantenException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

     // Pas de gegevens van een klant aan.
    public function update(UpdateKlantenRequest $request, Klanten $klanten, UpdateKlantenAction $action): KlantenUpdateResponse|JsonResponse
    {
        try {
            $klantenData = KlantenUpdateData::fromRequest($request->validated());
            $klantenAction = $action->execute($klanten, $klantenData);

            return new KlantenUpdateResponse($klantenAction);
        } catch (UpdateKlantenException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
