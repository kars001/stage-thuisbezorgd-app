<?php

namespace App\Console\Commands;

use Domain\Bestellingen\Actions\CancelBestellingenAction;
use Domain\Bestellingen\Models\Bestellingen;
use Illuminate\Console\Command;

class CancelOutdatedOrdersCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:outdated-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel orders that are not paid for within 15 minutes.';

    /**
     * Execute the console command.
     */

    public function __construct(
        private readonly CancelBestellingenAction $cancelBestellingenAction
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $bestellingen = Bestellingen::query()->getBestellingenForCancellation()->get();

        /** @var Bestellingen $bestelling */
        foreach ($bestellingen as $bestelling) {
            $this->cancelBestellingenAction->execute($bestelling);
        }
    }
}
