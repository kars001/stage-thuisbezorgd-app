<?php

namespace App\Admin\Producten\Filament\Resources\Categorieen\Pages;

use App\Admin\Producten\Filament\Resources\Categorieen\CategorieenResource;
use Domain\Producten\Actions\UpdateCategorieenAction;
use Domain\Producten\DataTransferObjects\CategorieenUpsertData;
use Domain\Producten\Models\Categorie;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCategorieen extends EditRecord
{
    protected static string $resource = CategorieenResource::class;

    /**
     * @param Categorie $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $categorieenData = new CategorieenUpsertData(...$data);

        app(UpdateCategorieenAction::class)->execute($record, $categorieenData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
