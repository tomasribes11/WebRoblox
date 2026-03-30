<?php

// app/Http/Controllers/Api/CategoryController.php
// Returns the list of article categories with localized names.

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /api/v1/categories
    // Query params:
    //   locale — "es" (default), "en", "fr"
    public function index(Request $request): JsonResponse
    {
        $supported = ['es', 'en', 'fr'];
        $locale    = $request->query('locale', 'es');
        $locale    = in_array($locale, $supported) ? $locale : 'es';

        $categories = Category::all()->map(fn ($category) => [
            'slug' => $category->slug,
            'name' => $category->getLocalizedName($locale),
        ]);

        return response()->json(['data' => $categories]);
    }
}
