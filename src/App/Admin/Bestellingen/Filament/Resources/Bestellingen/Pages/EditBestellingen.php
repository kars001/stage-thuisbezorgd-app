<?php

namespace App\Admin\Bestellingen\Filament\Resources\Bestellingen\Pages;

use App\Admin\Bestellingen\Filament\Resources\Bestellingen\BestellingenResource;
use Domain\Bestellingen\Actions\UpdateBestellingenAction;
use Domain\Bestellingen\DataTransferObjects\BestellingUpsertData;
use Domain\Bestellingen\Models\Bestellingen;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBestellingen extends EditRecord
{
    protected static string $resource = BestellingenResource::class;

    /**
     * @param  Bestellingen  $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        /** @var Bestellingen $record */
        $userData = new BestellingUpsertData(
            status: $data['status'],
            klanten_id: $record->klanten_id,
            restaurant_id: $record->restaurant_id,
            verzendkosten: $record->verzendkosten,
            totaalprijs: $record->totaalprijs,
        );

        app(UpdateBestellingenAction::class)->execute($record, $userData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
