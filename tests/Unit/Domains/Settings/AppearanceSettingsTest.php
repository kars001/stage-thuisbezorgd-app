<?php

namespace Tests\Unit\Domains\Settings;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Support\Settings\AppearanceSettings;
use Tests\TestCase;

class AppearanceSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_default_settings(): void
    {
        // Get the settings
        $settings = app(AppearanceSettings::class);

        // Assert default values
        $this->assertEquals('#f59e0b', $settings->primary_color);
        $this->assertEquals('#6b7280', $settings->secondary_color);
        $this->assertEquals('Inter, sans-serif', $settings->font_family);
        $this->assertEquals('/images/logo.png', $settings->logo_path);
        $this->assertEquals('/favicon.ico', $settings->favicon_path);
    }

    public function test_it_can_update_settings(): void
    {
        // Get the settings
        $settings = app(AppearanceSettings::class);

        // Update settings
        $settings->primary_color = '#ff0000';
        $settings->secondary_color = '#00ff00';
        $settings->font_family = 'Roboto, sans-serif';
        $settings->logo_path = '/images/custom-logo.png';
        $settings->favicon_path = '/custom-favicon.ico';
        $settings->save();

        // Reload settings
        $reloadedSettings = app(AppearanceSettings::class);

        // Assert updated values
        $this->assertEquals('#ff0000', $reloadedSettings->primary_color);
        $this->assertEquals('#00ff00', $reloadedSettings->secondary_color);
        $this->assertEquals('Roboto, sans-serif', $reloadedSettings->font_family);
        $this->assertEquals('/images/custom-logo.png', $reloadedSettings->logo_path);
        $this->assertEquals('/custom-favicon.ico', $reloadedSettings->favicon_path);
    }
}
