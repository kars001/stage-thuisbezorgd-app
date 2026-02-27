<?php

namespace Domain\Restaurants\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum RestaurantStatusEnum: string implements HasLabel, HasColor
{
    case Open = 'open';
    case Gesloten = 'gesloten';

    public function getLabel(): string
    {
        return match ($this) {
            self::Open => 'Open',
            self::Gesloten => 'Gesloten',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Open => 'success',
            self::Gesloten => 'danger',
        };
    }
}
