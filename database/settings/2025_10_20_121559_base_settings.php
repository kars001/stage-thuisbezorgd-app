<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('appearance.primary_color', '#f59e0b');
        $this->migrator->add('appearance.secondary_color', '#6b7280');
        $this->migrator->add('appearance.font_family', 'Inter, sans-serif');
        $this->migrator->add('appearance.logo_path', '/images/logo.png');
        $this->migrator->add('appearance.favicon_path', '/favicon.ico');

        $this->migrator->add('passport.token_lifetime', 24 * 60 * 60);
        $this->migrator->add('passport.refresh_token_lifetime', 30 * 24 * 60 * 60);
        $this->migrator->add('passport.prune_revoked_tokens', true);
        $this->migrator->add('passport.prune_auth_codes', true);
    }
};
