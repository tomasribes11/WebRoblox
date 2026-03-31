<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Article;
use App\Models\ArticleTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create specific test categories
        $trucosCategory = Category::firstOrCreate(
            ['slug' => 'trucos'],
            ['name_es' => 'Trucos', 'name_en' => 'Tricks', 'name_fr' => 'Astuces']
        );
        $guiasCategory = Category::firstOrCreate(
            ['slug' => 'guias'],
            ['name_es' => 'Guías', 'name_en' => 'Guides', 'name_fr' => 'Guides']
        );
        
        // Create test articles with specific categories and translations
        for ($i = 0; $i < 8; $i++) {
            $article = Article::factory()->create([
                'category_id' => $trucosCategory->id,
                'is_published' => true,
            ]);
            ArticleTranslation::factory()->create([
                'article_id' => $article->id,
                'locale' => 'es',
            ]);
        }
        
        for ($i = 0; $i < 7; $i++) {
            $article = Article::factory()->create([
                'category_id' => $guiasCategory->id,
                'is_published' => true,
            ]);
            ArticleTranslation::factory()->create([
                'article_id' => $article->id,
                'locale' => 'es',
            ]);
        }
    }

    public function test_can_list_articles()
    {
        $response = $this->getJson('/api/v1/articles');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'slug',
                            'cover_image',
                            'view_count',
                            'published_at',
                            'category' => [
                                'slug',
                                'name'
                            ],
                            'title',
                            'description'
                        ]
                    ],
                    'meta' => [
                        'current_page',
                        'last_page',
                        'per_page',
                        'total'
                    ]
                ]);
    }

    public function test_can_filter_articles_by_category()
    {
        $response = $this->getJson('/api/v1/articles?category=trucos');

        $response->assertStatus(200);
        
        // Check all returned articles belong to 'trucos' category
        $articles = $response->json('data');
        foreach ($articles as $article) {
            $this->assertEquals('trucos', $article['category']['slug']);
        }
    }

    public function test_can_get_single_article()
    {
        $article = Article::first();
        
        $response = $this->getJson("/api/v1/articles/{$article->slug}");

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        'id',
                        'slug',
                        'cover_image',
                        'view_count',
                        'published_at',
                        'category' => [
                            'slug',
                            'name'
                        ],
                        'title',
                        'description',
                        'content'
                    ]
                ]);
    }

    public function test_returns_404_for_nonexistent_article()
    {
        $response = $this->getJson('/api/v1/articles/nonexistent-article');

        $response->assertStatus(404);
    }

    public function test_can_list_categories()
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'slug',
                            'name'
                        ]
                    ]
                ]);
    }
}
