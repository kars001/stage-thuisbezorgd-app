<?php

namespace App\Admin\Producten\Filament\Resources\Allergieen\Pages;

use App\Admin\Producten\Filament\Resources\Allergieen\AllergieenResource;
use Domain\Producten\Actions\UpdateAllergieenAction;
use Domain\Producten\DataTransferObjects\AllergieenUpsertData;
use Domain\Producten\Models\Allergieen;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditAllergieen extends EditRecord
{
    protected static string $resource = AllergieenResource::class;

    /**
     * @param Allergieen $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $allergieenData = new AllergieenUpsertData(...$data);

        app(UpdateAllergieenAction::class)->execute($record, $allergieenData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
