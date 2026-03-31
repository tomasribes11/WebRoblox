<?php

// bootstrap/providers.php
// List of service providers to load. Laravel 11 uses this file
// instead of the providers array in config/app.php.

return [
    App\Providers\AppServiceProvider::class,
    App\Filament\AdminPanelProvider::class,
];
