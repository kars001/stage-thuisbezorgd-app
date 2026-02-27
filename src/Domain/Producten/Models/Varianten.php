<?php

namespace Domain\Producten\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Varianten extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'varianten';

    protected $fillable = [
        'naam',
    ];

    /**
     * @return BelongsToMany<Producten, $this>
     */
    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(
            Producten::class,
            'variant_product',
            'variant_id',
            'product_id',
        )->withPivot('extra_prijs');
    }
}
