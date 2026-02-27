<?php

namespace Domain\Producten\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Categorie extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'categorieen';

    protected $fillable = [
        'naam',
    ];
}
