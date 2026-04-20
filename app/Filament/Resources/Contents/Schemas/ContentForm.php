<?php

namespace App\Filament\Resources\Contents\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) =>
                        $set('slug', $state ? Str::slug($state) : '')
                    )
                    ->columnSpan(1),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated from title. You may customise it.')
                    ->columnSpan(1),

                // ── Row 2: Type + Status ─────────────────────────────────────
                Select::make('type')
                    ->options([
                        'blog' => 'Blog Post',
                        'page' => 'Static Page',
                    ])
                    ->required()
                    ->helperText('Events, Projects and Reports are managed in their own sections.')
                    ->columnSpan(1),

                Radio::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->default('draft')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        if ($state === 'published') {
                            $set('published_at', now()->toDateTimeString());
                        }
                    })
                    ->inline()
                    ->columnSpan(1),

                // ── Row 3: Categories (thematic topics this content belongs to) ─
                Select::make('categories')
                    ->label('Categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->helperText('Tag this content with relevant thematic categories.')
                    ->columnSpan(1),

                // Published at — shown when status is published
                DateTimePicker::make('published_at')
                    ->label('Published At')
                    ->nullable()
                    ->columnSpan(1),

                // ── Row 4: Featured image ─────────────────────────────────────
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->disk('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->directory('content/images')
                    ->visibility('public')
                    ->columnSpanFull(),

                // ── Row 5: Excerpt ────────────────────────────────────────────
                RichEditor::make('excerpt')
                    ->columnSpanFull(),

                // ── Row 6: Body ───────────────────────────────────────────────
                RichEditor::make('body')
                    ->label('Content Body')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
