<?php

namespace App\Admin\Restaurants\Filament\Resources\Restaurants\Pages;

use App\Admin\Restaurants\Filament\Resources\Restaurants\RestaurantResource;
use Domain\Restaurants\Actions\CreateRestaurantAction;
use Domain\Restaurants\DataTransferObjects\RestaurantUpsertData;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageRestaurants extends ManageRecords
{
    protected static string $resource = RestaurantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->using(function (array $data): Model {
                    $restaurantData = new RestaurantUpsertData(...$data);

                    return app(CreateRestaurantAction::class)->execute($restaurantData);
                }),
        ];
    }
}
