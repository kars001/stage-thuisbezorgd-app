<?php

namespace Tests\Unit\Domains\Settings;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Support\Settings\PassportSettings;
use Tests\TestCase;

class PassportSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_default_settings(): void
    {
        // Get the settings
        $settings = app(PassportSettings::class);

        // Assert default values
        $this->assertEquals(24 * 60 * 60, $settings->token_lifetime);
        $this->assertEquals(30 * 24 * 60 * 60, $settings->refresh_token_lifetime);
        $this->assertTrue($settings->prune_revoked_tokens);
        $this->assertTrue($settings->prune_auth_codes);
    }

    public function test_it_can_update_settings(): void
    {
        // Get the settings
        $settings = app(PassportSettings::class);

        // Update settings
        $settings->token_lifetime = 12 * 60 * 60; // 12 hours
        $settings->refresh_token_lifetime = 15 * 24 * 60 * 60; // 15 days
        $settings->prune_revoked_tokens = false;
        $settings->prune_auth_codes = false;
        $settings->save();

        // Reload settings
        $reloadedSettings = app(PassportSettings::class);

        // Assert updated values
        $this->assertEquals(12 * 60 * 60, $reloadedSettings->token_lifetime);
        $this->assertEquals(15 * 24 * 60 * 60, $reloadedSettings->refresh_token_lifetime);
        $this->assertFalse($reloadedSettings->prune_revoked_tokens);
        $this->assertFalse($reloadedSettings->prune_auth_codes);
    }
}
