<?php

namespace Domain\Bestellingen\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BestellingStatusEnum: string implements HasLabel, HasColor
{
    case Gemaakt = 'gemaakt';
    case Bevestigd = 'bevestigd';
    case InVoorbereiding = 'in_voorbereiding';
    case Klaar = 'klaar';
    case Onderweg = 'onderweg';
    case Afgeleverd = 'afgeleverd';
    case Geannuleerd = 'geannuleerd';

    public function getLabel(): string
    {
        return match ($this) {
            self::Gemaakt => 'Gemaakt',
            self::Bevestigd => 'Bevestigd',
            self::InVoorbereiding => 'In voorbereiding',
            self::Klaar => 'Klaar',
            self::Onderweg => 'Onderweg',
            self::Afgeleverd => 'Afgeleverd',
            self::Geannuleerd => 'Geannuleerd',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Gemaakt => 'gray',
            self::Bevestigd, self::Onderweg => 'info',
            self::InVoorbereiding => 'warning',
            self::Klaar => 'primary',
            self::Afgeleverd => 'success',
            self::Geannuleerd => 'danger',
        };
    }
}
