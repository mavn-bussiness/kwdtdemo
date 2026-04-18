<?php

namespace App\Filament\Resources\Contents\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ── Row 1: Core identifiers ───────────────────────────────────
                TextEntry::make('title'),
                TextEntry::make('slug'),

                // ── Row 2: Classification ─────────────────────────────────────
                TextEntry::make('type')
                    ->placeholder('-'),
                TextEntry::make('categories.name')
                    ->label('Category')
                    ->badge()
                    ->separator(','),

                // ── Row 3: Publication ────────────────────────────────────────
                TextEntry::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft'     => 'warning',
                        'archived'  => 'danger',
                        default     => 'gray',
                    }),
                TextEntry::make('published_at')
                    ->dateTime()
                    ->placeholder('Not published yet'),

                // ── Row 4: Author ─────────────────────────────────────────────
                TextEntry::make('author.name')
                    ->label('Author')
                    ->placeholder('-'),

                // ── Row 5: Featured image ─────────────────────────────────────
                ImageEntry::make('featured_image')
                    ->label('Featured Image')
                    ->columnSpanFull()
                    ->placeholder('-'),

                // ── Row 6: Text content ───────────────────────────────────────
                TextEntry::make('excerpt')
                    ->columnSpanFull()
                    ->placeholder('-'),
                TextEntry::make('body')
                    ->label('Content')
                    ->columnSpanFull()
                    ->placeholder('-'),

                // ── Row 7: Timestamps ─────────────────────────────────────────
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ])
            ->columns(2);
    }
}
