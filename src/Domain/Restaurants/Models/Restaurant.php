<?php

namespace Domain\Restaurants\Models;

use Domain\Restaurants\Enums\RestaurantStatusEnum;
use Domain\Restaurants\QueryBuilders\RestaurantQueryBuilder;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $naam
 * @property ?string $beschrijving
 * @property ?string $adres
 * @property ?array<string, mixed> $bezorggebied
 * @property ?array<string, mixed> $openingstijden
 * @property ?array<string, mixed> $sluitingstijden
 * @property ?float $minimaal_bestelbedrag
 * @property ?float $bezorgkosten
 * @property RestaurantStatusEnum $status
 * @property ?string $logo_url
 * @property ?string $header_url
 */
#[UseEloquentBuilder(RestaurantQueryBuilder::class)]
class Restaurant extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass-assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'naam',
        'beschrijving',
        'adres',
        'bezorggebied',
        'open_en_sluit_tijden',
        'minimaal_bestelbedrag',
        'bezorgkosten',
        'status',
        'logo_url',
        'header_url'
    ];

    protected $casts = [
        'bezorggebied' => 'array',
        'open_en_sluit_tijden' => 'array',
        'status' => RestaurantStatusEnum::class,
    ];
}
