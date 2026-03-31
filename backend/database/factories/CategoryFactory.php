<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['slug' => 'trucos', 'name_es' => 'Trucos', 'name_en' => 'Tricks', 'name_fr' => 'Astuces'],
            ['slug' => 'guias', 'name_es' => 'Guías', 'name_en' => 'Guides', 'name_fr' => 'Guides'],
            ['slug' => 'noticias', 'name_es' => 'Noticias', 'name_en' => 'News', 'name_fr' => 'Actualités'],
            ['slug' => 'tutoriales', 'name_es' => 'Tutoriales', 'name_en' => 'Tutorials', 'name_fr' => 'Tutoriels'],
        ];

        $category = fake()->randomElement($categories);
        
        return [
            'slug' => $category['slug'],
            'name_es' => $category['name_es'],
            'name_en' => $category['name_en'],
            'name_fr' => $category['name_fr'],
        ];
    }
}
