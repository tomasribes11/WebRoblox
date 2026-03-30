<?php

// database/migrations/2024_01_01_200000_create_categories_table.php
// Article categories: trucos, guias, noticias.
// Names stored in 3 locales (no separate translation table — categories are static).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->string('name_es', 255);
            $table->string('name_en', 255);
            $table->string('name_fr', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
