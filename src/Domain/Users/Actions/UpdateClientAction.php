<?php

namespace Domain\Users\Actions;

use Domain\Users\DataTransferObjects\ClientUpsertData;
use Laravel\Passport\Client;

class UpdateClientAction
{
    public function execute(
        Client           $client,
        ClientUpsertData $data,
    ): Client
    {
        $clientData = $data->toArray();

        if ($client->getAttribute('secret') && !empty($clientData['secret'])) {
            unset($clientData['secret']);
        }

        $client->fill($clientData);
        $client->save();

        return $client;
    }
}
