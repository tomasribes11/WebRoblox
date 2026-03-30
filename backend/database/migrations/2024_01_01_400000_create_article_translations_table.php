<?php

// database/migrations/2024_01_01_400000_create_article_translations_table.php
// All localizable text content for articles.
// UNIQUE(article_id, locale) ensures one translation per language per article.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')
                  ->constrained('articles')
                  ->cascadeOnDelete(); // deleting an article removes all its translations
            $table->enum('locale', ['es', 'en', 'fr']);
            $table->string('title', 500);
            $table->string('description', 1000);
            $table->longText('content');
            $table->timestamps();

            // One translation per locale per article
            $table->unique(['article_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_translations');
    }
};
