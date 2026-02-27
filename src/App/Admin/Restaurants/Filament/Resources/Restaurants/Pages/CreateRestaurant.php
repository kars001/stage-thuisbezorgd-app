<?php

namespace App\Admin\Restaurants\Filament\Resources\Restaurants\Pages;

use App\Admin\Restaurants\Filament\Resources\Restaurants\RestaurantResource;
use Domain\Restaurants\Actions\CreateRestaurantAction;
use Domain\Restaurants\DataTransferObjects\RestaurantUpsertData;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateRestaurant extends CreateRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $restaurantData = new RestaurantUpsertData(...$data);

        return app(CreateRestaurantAction::class)->execute($restaurantData);
    }

    protected function getRedirectUrl(): string
    {
        return RestaurantResource::getUrl('index');
    }
}
