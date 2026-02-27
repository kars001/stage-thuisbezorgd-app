<?php

namespace Domain\Bestellingen\Models;

use Domain\Bestellingen\Enums\BestellingStatusEnum;
use Domain\Bestellingen\QueryBuilders\BestellingenQueryBuilder;
use Domain\Klanten\Models\Klanten;
use Domain\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Bestellingen query builder
#[UseEloquentBuilder(BestellingenQueryBuilder::class)]

class Bestellingen extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'bestellingen';

    protected $fillable = [
        'status',
        'verzendkosten',
        'totaalprijs',
        'klanten_id',
        'restaurant_id',
    ];

    protected $casts = [
        'status' => BestellingStatusEnum::class,
    ];

    /**
     * @return BelongsTo<Klanten, $this>
     */
    // De klant die bij deze bestelling hoort
    public function klanten(): BelongsTo
    {
        return $this->belongsTo(Klanten::class, 'klanten_id');
    }

    /**
     * @return BelongsTo<Restaurant, $this>
     */
    // Het restaurant waar deze bestelling is geplaatst
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
