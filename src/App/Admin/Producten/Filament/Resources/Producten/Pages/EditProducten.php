<?php

namespace App\Admin\Producten\Filament\Resources\Producten\Pages;

use App\Admin\Producten\Filament\Resources\Producten\ProductenResource;
use Domain\Producten\Actions\UpdateProductenAction;
use Domain\Producten\DataTransferObjects\ProductenUpsertData;
use Domain\Producten\Models\Producten;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditProducten extends EditRecord
{
    protected static string $resource = ProductenResource::class;

    /**
     * @param  Producten  $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $productenData = new ProductenUpsertData(...$data);

        app(UpdateProductenAction::class)->execute($record, $productenData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
