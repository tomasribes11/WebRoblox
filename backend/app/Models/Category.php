<?php

// app/Models/Category.php
// Article categories (trucos, guias, noticias).
// Names stored in 3 locales directly on the model (no separate translation table
// since there are very few categories and their names rarely change).

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_es',
        'name_en',
        'name_fr',
    ];

    // Returns all articles belonging to this category
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    // Helper: get the category name in the requested locale
    public function getLocalizedName(string $locale): string
    {
        $column = 'name_'.$locale;

        return $this->{$column} ?? $this->name_es;
    }
}
