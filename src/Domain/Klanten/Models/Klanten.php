<?php

namespace Domain\Klanten\Models;

use Domain\Klanten\QueryBuilders\KlantenQueryBuilder;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Klanten query builder
#[UseEloquentBuilder(KlantenQueryBuilder::class)]
class Klanten extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'klanten';

    protected $fillable = [
        'voornaam',
        'achternaam',
        'adres',
        'email',
        'telefoonnummer',
    ];
}
