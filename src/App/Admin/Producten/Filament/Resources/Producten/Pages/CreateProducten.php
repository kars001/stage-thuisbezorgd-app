<?php

namespace App\Admin\Producten\Filament\Resources\Producten\Pages;

use App\Admin\Producten\Filament\Resources\Producten\ProductenResource;
use Domain\Producten\Actions\CreateProductenAction;
use Domain\Producten\DataTransferObjects\ProductenUpsertData;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProducten extends CreateRecord
{
    protected static string $resource = ProductenResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $productenData = new ProductenUpsertData(...$data);

        return app(CreateProductenAction::class)->execute($productenData);
    }

    protected function getRedirectUrl(): string
    {
        return ProductenResource::getUrl('index');
    }
}
