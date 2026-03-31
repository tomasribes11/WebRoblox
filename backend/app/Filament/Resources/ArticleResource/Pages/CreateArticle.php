<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\ArticleTranslation;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    // After the article is saved, save the translation rows from the tab fields.
    protected function afterCreate(): void
    {
        $this->saveTranslations();
    }

    private function saveTranslations(): void
    {
        foreach (['es', 'en', 'fr'] as $locale) {
            $title   = $this->data["translation_{$locale}_title"]   ?? '';
            $desc    = $this->data["translation_{$locale}_description"] ?? '';
            $content = $this->data["translation_{$locale}_content"] ?? '';

            if ($title) {
                ArticleTranslation::updateOrCreate(
                    ['article_id' => $this->record->id, 'locale' => $locale],
                    ['title' => $title, 'description' => $desc, 'content' => $content]
                );
            }
        }
    }
}
