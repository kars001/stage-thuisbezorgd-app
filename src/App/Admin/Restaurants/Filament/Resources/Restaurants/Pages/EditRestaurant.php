<?php

namespace App\Admin\Restaurants\Filament\Resources\Restaurants\Pages;

use App\Admin\Restaurants\Filament\Resources\Restaurants\RestaurantResource;
use Domain\Restaurants\Actions\UpdateRestaurantAction;
use Domain\Restaurants\DataTransferObjects\RestaurantUpsertData;
use Domain\Restaurants\Models\Restaurant;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRestaurant extends EditRecord
{
    protected static string $resource = RestaurantResource::class;

    /**
     * @param  Restaurant  $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $userData = new RestaurantUpsertData(...$data);

        app(UpdateRestaurantAction::class)->execute($record, $userData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
