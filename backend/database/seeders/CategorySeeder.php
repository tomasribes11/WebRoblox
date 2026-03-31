<?php

// database/seeders/CategorySeeder.php
// Seeds the 3 article categories with their names in all 3 supported locales.

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'slug'    => 'trucos',
                'name_es' => 'Trucos',
                'name_en' => 'Tricks',
                'name_fr' => 'Astuces',
            ],
            [
                'slug'    => 'guias',
                'name_es' => 'Guías',
                'name_en' => 'Guides',
                'name_fr' => 'Guides',
            ],
            [
                'slug'    => 'noticias',
                'name_es' => 'Noticias',
                'name_en' => 'News',
                'name_fr' => 'Actualités',
            ],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
