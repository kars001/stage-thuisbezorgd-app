<?php

namespace Domain\Users\Models;

use Database\Factories\Domain\Users\UserFactory;
use Domain\Users\Collections\UserCollection;
use Domain\Users\Policies\UserPolicy;
use Domain\Users\QueryBuilders\UserQueryBuilder;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\CollectedBy;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Passport\Contracts\OAuthenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $two_factor_secret
 * @property Collection<int, SocialLogin> $socialLogins
 *
 * @method static UserQueryBuilder query()
 */
#[CollectedBy(UserCollection::class)]
#[UseEloquentBuilder(UserQueryBuilder::class)]
#[UsePolicy(UserPolicy::class)]
class User extends Authenticatable implements OAuthenticatable, FilamentUser
{
    use HasApiTokens, TwoFactorAuthenticatable;

    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**
     * @return HasMany<SocialLogin, $this>
     */
    public function socialLogins(): HasMany
    {
        return $this->hasMany(SocialLogin::class);
    }
}
