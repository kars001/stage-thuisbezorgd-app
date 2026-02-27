<?php

namespace Domain\Producten\Models;

use Domain\Producten\QueryBuilders\ProductenQueryBuilder;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Domain\Restaurants\Models\Restaurant;

#[UseEloquentBuilder(ProductenQueryBuilder::class)]
class Producten extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'producten';

    protected $fillable = [
        'restaurant_id',
        'naam',
        'beschrijving',
        'prijs',
    ];

    /**
     * @return BelongsTo<Restaurant, $this>
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * @return BelongsToMany<Varianten, $this>
     */
    public function varianten(): BelongsToMany
    {
        return $this->belongsToMany(
            Varianten::class,
            'variant_product',
            'product_id',
            'variant_id',
        )->withPivot('extra_prijs');
    }

    /**
     * @return BelongsToMany<Categorie, $this>
     */
    public function categorieen(): BelongsToMany
    {
        return $this->belongsToMany(
            Categorie::class,
            'categorie_product',
            'product_id',
            'categorie_id',
        );
    }

    /**
     * @return BelongsToMany<Allergieen, $this>
     */
    public function allergieen(): BelongsToMany
    {
        return $this->belongsToMany(
            Allergieen::class,
            'allergie_product',
            'product_id',
            'allergie_id',
        );
    }
}
