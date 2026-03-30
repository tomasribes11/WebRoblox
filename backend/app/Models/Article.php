<?php

// app/Models/Article.php
// An article is locale-agnostic: it has a slug, category, image, and publication state.
// All translated content (title, description, body) lives in ArticleTranslation.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'category_id',
        'cover_image',
        'is_published',
        'published_at',
        'view_count',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    // Category this article belongs to
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // All translations (ES, EN, FR)
    public function translations(): HasMany
    {
        return $this->hasMany(ArticleTranslation::class);
    }

    // Scope: only return published articles
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Helper: get the translation for a given locale
    public function getTranslation(string $locale): ?ArticleTranslation
    {
        return $this->translations->firstWhere('locale', $locale)
            ?? $this->translations->firstWhere('locale', 'es'); // fallback to Spanish
    }
}
