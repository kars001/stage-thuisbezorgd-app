<?php

namespace App\Console\Commands;

use Domain\Restaurants\Actions\DeleteRestaurantAction;
use Domain\Restaurants\Models\Restaurant;
use Illuminate\Console\Command;

class DeleteSoftDeletedRecordsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:soft-deletes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete soft deleted records older than 30 days.';

    /**
     * Execute the console command.
     */

    public function __construct(
        private readonly DeleteRestaurantAction $deleteRestaurantAction
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        // Verwijder restaurants die ouder zijn dan 30 dagen
        $restaurants = Restaurant::query()->onlyDeletedOlderThan(30)->get(['id', 'logo_url', 'header_url']);

        /** @var Restaurant $restaurant */
        foreach ($restaurants as $restaurant) {
            $this->deleteRestaurantAction->execute($restaurant);
        }
    }
}
