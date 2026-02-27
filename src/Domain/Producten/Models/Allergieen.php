<?php

namespace Domain\Producten\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Allergieen extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'allergieen';

    protected $fillable = [
        'naam',
    ];
}
