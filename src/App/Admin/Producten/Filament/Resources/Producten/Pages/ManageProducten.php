<?php

namespace App\Admin\Producten\Filament\Resources\Producten\Pages;

use App\Admin\Producten\Filament\Resources\Producten\ProductenResource;
use Domain\Producten\Actions\CreateProductenAction;
use Domain\Producten\DataTransferObjects\ProductenUpsertData;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageProducten extends ManageRecords
{
    protected static string $resource = ProductenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->using(function (array $data): Model {
                    $productenData = new ProductenUpsertData(...$data);

                    return app(CreateProductenAction::class)->execute($productenData);
                }),
        ];
    }
}
