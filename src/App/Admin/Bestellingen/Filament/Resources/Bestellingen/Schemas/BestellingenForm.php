<?php

namespace App\Admin\Bestellingen\Filament\Resources\Bestellingen\Schemas;

use Domain\Bestellingen\Enums\BestellingStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class BestellingenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')
                    ->options(
                        collect(BestellingStatusEnum::cases())
                            ->filter(fn($case) => in_array($case, [
                                BestellingStatusEnum::InVoorbereiding,
                                BestellingStatusEnum::Klaar,
                                BestellingStatusEnum::Onderweg,
                                BestellingStatusEnum::Afgeleverd,
                                BestellingStatusEnum::Geannuleerd
                            ]))
                            ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
                            ->toArray()
                    )
                    ->required()
                    ->native(false),
            ]);
    }
}
