<?php

namespace Domain\Bestellingen\Models;

use Domain\Bestellingen\QueryBuilders\OrderItemsQueryBuilder;
use Domain\Producten\Models\Producten;
use Domain\Producten\Models\Varianten;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

// OrderItems query builder
#[UseEloquentBuilder(OrderItemsQueryBuilder::class)]
class OrderItems extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'order_items';

    protected $fillable = [
        'prijs',
        'aantal',
        'bestellingen_id',
        'producten_id',
        'varianten_id',
    ];

    /**
     * @return BelongsTo<Bestellingen, $this>
     */
    // De bestelling waar dit artikel bij hoort
    public function bestellingen(): BelongsTo
    {
        return $this->belongsTo(Bestellingen::class, 'bestellingen_id');
    }

    /**
     * @return BelongsTo<Producten, $this>
     */
    // Het product van dit artikel
    public function producten(): BelongsTo
    {
        return $this->belongsTo(Producten::class, 'producten_id');
    }

    /**
     * @return BelongsTo<Varianten, $this>
     */
    // De variant van dit artikel
    public function varianten(): BelongsTo
    {
        return $this->belongsTo(Varianten::class, 'varianten_id');
    }
}
