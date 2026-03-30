<?php

// database/seeders/DatabaseSeeder.php
// Main seeder — runs all individual seeders in the correct order.
// Run with: php artisan db:seed

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Order matters: categories must exist before articles
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
