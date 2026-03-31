<?php

// app/Providers/AppServiceProvider.php
// Application service provider — bootstrap services and register gates.

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Grant Filament admin panel access only to users with role='admin'.
        // This gate is checked by Filament's middleware before rendering any admin page.
        Gate::define('viewFilament', function (User $user) {
            return $user->isAdmin();
        });
    }
}
