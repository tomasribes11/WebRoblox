<?php

// routes/web.php
// Web routes — Filament admin panel registers its own routes automatically
// via its service provider. We only need the health check here.

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Mundo Roblox API is running.', 'version' => '1.0']);
});
