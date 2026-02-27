<?php

namespace Domain\Users\Actions;

use Domain\Users\DataTransferObjects\ClientUpsertData;
use Laravel\Passport\Client;

class CreateClientAction
{
    public function execute(
        ClientUpsertData $data,
    ): Client
    {
        $clientData = $data->toArray();

        $client = new Client($clientData);
        $client->save();

        return $client;
    }
}
