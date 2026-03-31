<?php

// app/Http/Controllers/Api/ArticleController.php
// Public API for reading articles. No authentication required.
// Supports locale, category, and pagination query params.

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // GET /api/v1/articles
    // Query params:
    //   locale   — "es" (default), "en", "fr"
    //   category — category slug, e.g. "trucos"
    //   page     — page number (default 1)
    //   per_page — items per page (default 12, max 30)
    public function index(Request $request): JsonResponse
    {
        $locale  = $this->resolveLocale($request);
        $perPage = min((int) $request->query('per_page', 12), 30);

        $query = Article::published()
            ->with(['category', 'translations' => fn ($q) => $q->where('locale', $locale)])
            ->latest('published_at');

        // Filter by category slug if provided
        if ($category = $request->query('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $category));
        }

        $articles = $query->paginate($perPage);

        return response()->json([
            'data'  => $articles->map(fn ($article) => $this->formatArticle($article, $locale, brief: true)),
            'meta'  => [
                'current_page' => $articles->currentPage(),
                'last_page'    => $articles->lastPage(),
                'per_page'     => $articles->perPage(),
                'total'        => $articles->total(),
            ],
        ]);
    }

    // GET /api/v1/articles/{slug}
    // Returns the full article with content in the requested locale.
    // Also increments view_count.
    public function show(Request $request, string $slug): JsonResponse
    {
        $locale = $this->resolveLocale($request);

        $article = Article::published()
            ->with(['category', 'translations'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count (fire-and-forget)
        $article->increment('view_count');

        return response()->json([
            'data' => $this->formatArticle($article, $locale, brief: false),
        ]);
    }

    // ─── Private helpers ──────────────────────────────────────────────────

    // Validates and resolves the locale from query params.
    // Falls back to 'es' if missing or unsupported.
    private function resolveLocale(Request $request): string
    {
        $supported = ['es', 'en', 'fr'];
        $locale    = $request->query('locale', 'es');

        return in_array($locale, $supported) ? $locale : 'es';
    }

    // Shapes an article into the API response format.
    // brief=true omits the full content (used in list views).
    private function formatArticle(Article $article, string $locale, bool $brief): array
    {
        $translation = $article->getTranslation($locale);

        $data = [
            'id'           => $article->id,
            'slug'         => $article->slug,
            'cover_image'  => $article->cover_image,
            'view_count'   => $article->view_count,
            'published_at' => $article->published_at?->toISOString(),
            'category'     => [
                'slug' => $article->category->slug,
                'name' => $article->category->getLocalizedName($locale),
            ],
            'title'       => $translation?->title,
            'description' => $translation?->description,
        ];

        if (! $brief) {
            $data['content'] = $translation?->content;
        }

        return $data;
    }
}
