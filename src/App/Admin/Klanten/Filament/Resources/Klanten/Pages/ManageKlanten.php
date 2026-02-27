<?php

namespace App\Admin\Klanten\Filament\Resources\Klanten\Pages;

use App\Admin\Klanten\Filament\Resources\Klanten\KlantenResource;
use Filament\Resources\Pages\ManageRecords;

class ManageKlanten extends ManageRecords
{
    protected static string $resource = KlantenResource::class;
}
