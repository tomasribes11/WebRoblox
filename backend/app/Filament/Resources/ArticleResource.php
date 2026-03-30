<?php

// app/Filament/Resources/ArticleResource.php
// Filament 3 admin panel resource for managing articles.
// Provides a full CRUD UI at /admin/articles.
// Translations (ES/EN/FR) are managed via tabs inside the form.

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Artículos';

    protected static ?string $modelLabel = 'Artículo';

    protected static ?string $pluralModelLabel = 'Artículos';

    public static function form(Form $form): Form
    {
        return $form->schema([

            // ─── Article metadata ──────────────────────────────────────────
            Section::make('Configuración del artículo')->schema([
                TextInput::make('slug')
                    ->label('Slug (URL amigable)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('mi-articulo-sobre-roblox')
                    ->helperText('Solo letras minúsculas, números y guiones. Ejemplo: trucos-robux-2024'),

                Select::make('category_id')
                    ->label('Categoría')
                    ->options(Category::all()->pluck('name_es', 'id'))
                    ->required(),

                TextInput::make('cover_image')
                    ->label('URL de imagen de portada')
                    ->url()
                    ->placeholder('https://...')
                    ->nullable(),

                Toggle::make('is_published')
                    ->label('Publicado')
                    ->helperText('Solo los artículos publicados aparecen en el sitio web'),
            ])->columns(2),

            // ─── Translations per locale ───────────────────────────────────
            Section::make('Contenido por idioma')->schema([
                Tabs::make('Traducciones')->tabs([

                    Tabs\Tab::make('🇪🇸 Español')->schema([
                        TextInput::make('translation_es_title')
                            ->label('Título')
                            ->required()
                            ->maxLength(500),
                        TextInput::make('translation_es_description')
                            ->label('Descripción corta')
                            ->required()
                            ->maxLength(1000),
                        RichEditor::make('translation_es_content')
                            ->label('Contenido completo')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'h2', 'h3',
                                'link', 'undo', 'redo',
                            ]),
                    ]),

                    Tabs\Tab::make('🇬🇧 English')->schema([
                        TextInput::make('translation_en_title')
                            ->label('Title')
                            ->maxLength(500),
                        TextInput::make('translation_en_description')
                            ->label('Short description')
                            ->maxLength(1000),
                        RichEditor::make('translation_en_content')
                            ->label('Full content')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'h2', 'h3',
                                'link', 'undo', 'redo',
                            ]),
                    ]),

                    Tabs\Tab::make('🇫🇷 Français')->schema([
                        TextInput::make('translation_fr_title')
                            ->label('Titre')
                            ->maxLength(500),
                        TextInput::make('translation_fr_description')
                            ->label('Description courte')
                            ->maxLength(1000),
                        RichEditor::make('translation_fr_content')
                            ->label('Contenu complet')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline',
                                'bulletList', 'orderedList',
                                'h2', 'h3',
                                'link', 'undo', 'redo',
                            ]),
                    ]),

                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name_es')
                    ->label('Categoría')
                    ->badge(),
                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Publicado'),
                Tables\Columns\TextColumn::make('view_count')
                    ->label('Visitas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publicado el')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name_es')
                    ->label('Categoría'),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit'   => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    // ─── Mutators to load/save translation tabs ────────────────────────────
    // Filament doesn't natively support related model fields in tabs,
    // so we use mutateFormDataBeforeFill and mutateFormDataBeforeSave
    // to map translation rows to flat form fields and back.

    public static function mutateFormDataBeforeFill(array $data): array
    {
        $article = Article::with('translations')->find($data['id'] ?? null);

        if ($article) {
            foreach (['es', 'en', 'fr'] as $locale) {
                $t = $article->translations->firstWhere('locale', $locale);
                $data["translation_{$locale}_title"]       = $t?->title ?? '';
                $data["translation_{$locale}_description"] = $t?->description ?? '';
                $data["translation_{$locale}_content"]     = $t?->content ?? '';
            }
        }

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Translation fields are saved in afterSave(), not here.
        // Remove them from the main article data to avoid mass assignment errors.
        foreach (['es', 'en', 'fr'] as $locale) {
            unset($data["translation_{$locale}_title"]);
            unset($data["translation_{$locale}_description"]);
            unset($data["translation_{$locale}_content"]);
        }

        return $data;
    }
}
