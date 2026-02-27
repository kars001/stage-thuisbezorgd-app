<?php

return [
    App\Admin\Providers\AppServiceProvider::class,
    App\Admin\Providers\Filament\AdminPanelProvider::class,
    \Support\Authentication\Providers\FortifyServiceProvider::class,
    \Support\Authentication\Providers\PassportSettingsServiceProvider::class,
];
