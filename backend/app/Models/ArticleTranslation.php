<?php

// app/Models/ArticleTranslation.php
// Stores all localizable content for an article in a single locale.
// Each article has one row per supported locale (es, en, fr).
// The UNIQUE constraint on (article_id, locale) prevents duplicates.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'locale',
        'title',
        'description',
        'content',
    ];

    // The article this translation belongs to
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
