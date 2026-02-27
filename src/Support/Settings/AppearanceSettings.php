<?php

namespace Support\Settings;

use Spatie\LaravelSettings\Settings;

class AppearanceSettings extends Settings
{
    public const DEFAULT_PRIMARY_COLOR = '#f59e0b';

    public const DEFAULT_SECONDARY_COLOR = '#6b7280';

    public const DEFAULT_LOGO = '/images/logo.svg';

    public string $primary_color;

    public string $secondary_color;

    public string $font_family;

    public string $logo_path;

    public string $favicon_path;

    public static function group(): string
    {
        return 'appearance';
    }

    /**
     * @return array<string, string>
     */
    public static function default(): array
    {
        return [
            'primary_color' => self::DEFAULT_PRIMARY_COLOR,
            'secondary_color' => self::DEFAULT_SECONDARY_COLOR,
            'font_family' => 'Inter, sans-serif',
            'logo_path' => self::DEFAULT_LOGO,
            'favicon_path' => '/favicon.ico',
        ];
    }
}
