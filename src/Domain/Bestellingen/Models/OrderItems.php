<?php

namespace Domain\Bestellingen\Models;

use Domain\Bestellingen\QueryBuilders\OrderItemsQueryBuilder;
use Domain\Producten\Models\Producten;
use Domain\Producten\Models\Varianten;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    public function bestellingen(): BelongsTo
    {
        return $this->belongsTo(Bestellingen::class, 'bestellingen_id');
    }

    /**
     * @return BelongsTo<Producten, $this>
     */
    public function producten(): BelongsTo
    {
        return $this->belongsTo(Producten::class, 'producten_id');
    }

    /**
     * @return BelongsTo<Varianten, $this>
     */
    public function varianten(): BelongsTo
    {
        return $this->belongsTo(Varianten::class, 'varianten_id');
    }
}
