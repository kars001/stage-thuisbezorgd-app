<?php

namespace App\Admin\Producten\Filament\Resources\Varianten\Pages;

use App\Admin\Producten\Filament\Resources\Varianten\VariantenResource;
use Domain\Producten\Actions\UpdateVariantenAction;
use Domain\Producten\DataTransferObjects\VariantenUpsertData;
use Domain\Producten\Models\Varianten;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditVarianten extends EditRecord
{
    protected static string $resource = VariantenResource::class;

    /**
     * @param Varianten $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $variantenData = new VariantenUpsertData(...$data);

        app(UpdateVariantenAction::class)->execute($record, $variantenData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
