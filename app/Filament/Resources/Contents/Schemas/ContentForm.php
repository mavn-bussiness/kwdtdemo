<?php

namespace App\Filament\Resources\Contents\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ── Row 1: Title + Slug (auto-generated, read-only) ──────────
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->columnSpan(1),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated from title. You may customise it.')
                    ->columnSpan(1),

                // ── Row 2: Category + Status ─────────────────────────────────
                Select::make('category_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->columnSpan(1),

                Radio::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->default('draft')
                    ->required()
                    ->inline()
                    ->columnSpan(1),

                // ── Row 3: Featured image ─────────────────────────────────────
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->directory('content/images')   // stored in storage/app/public/content/images
                    ->visibility('public')
                    ->columnSpanFull(),

                // ── Row 4: Excerpt ────────────────────────────────────────────
                MarkdownEditor::make('excerpt')
                    ->columnSpanFull(),

                // ── Row 5: Body ───────────────────────────────────────────────
                MarkdownEditor::make('body')
                    ->label('Content')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
