<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\ArticleTranslation;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    // Load translation fields into the form tabs before rendering.
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return ArticleResource::mutateFormDataBeforeFill($data);
    }

    // Strip translation fields from the article data before saving to articles table.
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return ArticleResource::mutateFormDataBeforeSave($data);
    }

    // After the article itself is updated, persist the translation rows.
    protected function afterSave(): void
    {
        foreach (['es', 'en', 'fr'] as $locale) {
            $title   = $this->data["translation_{$locale}_title"]       ?? '';
            $desc    = $this->data["translation_{$locale}_description"] ?? '';
            $content = $this->data["translation_{$locale}_content"]     ?? '';

            if ($title) {
                ArticleTranslation::updateOrCreate(
                    ['article_id' => $this->record->id, 'locale' => $locale],
                    ['title' => $title, 'description' => $desc, 'content' => $content]
                );
            }
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
