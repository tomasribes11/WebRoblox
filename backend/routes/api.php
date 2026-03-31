<?php

// routes/api.php
// All API routes are automatically prefixed with /api/v1 via bootstrap/app.php
// and the withRouting() + prefix configuration.
//
// Public routes: no authentication required (anyone can read articles)
// Protected routes: require a valid Sanctum Bearer token

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

// ─── Version prefix ───────────────────────────────────────────────────────
Route::prefix('v1')->group(function () {

    // ─── Authentication ───────────────────────────────────────────────────
    Route::prefix('auth')->group(function () {
        // Public: register and login
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

        // Protected: requires valid Bearer token
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/me', [AuthController::class, 'me']);
        });
    });

    // ─── Articles (public read) ────────────────────────────────────────────
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{slug}', [ArticleController::class, 'show']);

    // ─── Categories (public read) ──────────────────────────────────────────
    Route::get('/categories', [CategoryController::class, 'index']);

});
