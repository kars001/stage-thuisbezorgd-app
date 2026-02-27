<?php

namespace Domain\Users\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;

/**
 * @property int $id
 * @property string $provider_name
 * @property string $provider_id
 * @property string $provider_token
 */
class SocialLogin extends Model
{
    protected $fillable = [
        'provider_name',
        'provider_id',
    ];

    protected $hidden = [
        'provider_token',
    ];

    /**
     * @return Attribute<string, string>
     */
    protected function providerToken(): Attribute
    {
        return Attribute::make(
            get: static fn (string $value) => Crypt::decrypt($value),
            set: static fn (string $value) => Crypt::encrypt($value)
        );
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
