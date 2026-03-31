<?php

// config/cors.php
// Cross-Origin Resource Sharing (CORS) configuration.
// In dev: allows requests from the Vite dev server (localhost:5173).
// In prod: restrict allowed_origins to your actual domain.

return [

    // Apply CORS to all API routes
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // In development: allow all origins so the Vite dev server can call the API.
    // In production: replace with ['https://yoursite.com']
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Must be false when allowed_origins is ['*']
    // Set to true in production when using specific origins + credentials
    'supports_credentials' => false,

];
