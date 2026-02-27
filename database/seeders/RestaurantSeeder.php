<?php

namespace Database\Seeders;

use Domain\Restaurants\Actions\CreateRestaurantAction;
use Domain\Restaurants\DataTransferObjects\RestaurantUpsertData;
use Domain\Restaurants\Enums\RestaurantStatusEnum;
use Domain\Restaurants\Enums\RestaurantWeekDaysEnum;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = RestaurantStatusEnum::Open;

        $openingTimes = array_map(
            static fn (RestaurantWeekDaysEnum $day): array => [
                'dag' => $day->value,
                'open_tijd' => '09:00',
                'sluit_tijd' => '21:00',
            ],
            RestaurantWeekDaysEnum::cases()
        );

        app(CreateRestaurantAction::class)->execute(
            new RestaurantUpsertData(...[
                'naam' => 'test Restuarant',
                'beschrijving' => 'test Restuarant',
                'status' => $status,
                'bezorggebied' => ['test'],
                'open_en_sluit_tijden' => $openingTimes,
                'adres' => 'test adres',
            ])
        );
    }
}
