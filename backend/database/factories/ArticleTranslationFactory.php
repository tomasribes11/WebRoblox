<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleTranslation>
 */
class ArticleTranslationFactory extends Factory
{
    protected $model = ArticleTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article_id' => Article::factory(),
            'locale' => fake()->randomElement(['es', 'en', 'fr']),
            'title' => fake()->sentence(4),
            'description' => fake()->sentence(10),
            'content' => fake()->paragraphs(3, true),
        ];
    }
}
