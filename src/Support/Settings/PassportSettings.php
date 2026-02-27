<?php

namespace Support\Settings;

use Spatie\LaravelSettings\Settings;

class PassportSettings extends Settings
{
    public const DEFAULT_TOKEN_LIFETIME = 24 * 60 * 60;

    public const DEFAULT_REFRESH_TOKEN_LIFETIME = 30 * 24 * 60 * 60;

    public int $token_lifetime;

    public int $refresh_token_lifetime;

    public bool $prune_revoked_tokens;

    public bool $prune_auth_codes;

    public static function group(): string
    {
        return 'passport';
    }

    /**
     * @return array<string, int|bool>
     */
    public static function default(): array
    {
        return [
            'token_lifetime' => self::DEFAULT_TOKEN_LIFETIME,
            'refresh_token_lifetime' => self::DEFAULT_REFRESH_TOKEN_LIFETIME,
            'prune_revoked_tokens' => true,
            'prune_auth_codes' => true,
        ];
    }
}
