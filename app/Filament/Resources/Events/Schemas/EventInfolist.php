<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextEntry::make('content.title')
                    ->label('Title')
                    ->columnSpanFull(),
                TextEntry::make('content.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft'     => 'warning',
                        'archived'  => 'danger',
                        default     => 'gray',
                    }),
                TextEntry::make('content.published_at')
                    ->label('Published At')
                    ->dateTime()
                    ->placeholder('Not published yet'),
                TextEntry::make('content.categories.name')
                    ->label('Categories')
                    ->badge()
                    ->separator(',')
                    ->placeholder('-'),
                TextEntry::make('content.author.name')
                    ->label('Author')
                    ->placeholder('-'),
                TextEntry::make('event_date')
                    ->label('Start Date & Time')
                    ->dateTime(),
                TextEntry::make('end_date')
                    ->label('End Date & Time')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('venue')
                    ->placeholder('-'),
                TextEntry::make('district')
                    ->placeholder('-'),
                TextEntry::make('registration_url')
                    ->label('Registration URL')
                    ->placeholder('-'),
                TextEntry::make('capacity')
                    ->numeric()
                    ->placeholder('Unlimited'),
                ImageEntry::make('content.featured_image')
                    ->label('Featured Image')
                    ->columnSpanFull()
                    ->placeholder('-'),
                TextEntry::make('content.excerpt')
                    ->label('Excerpt')
                    ->columnSpanFull()
                    ->placeholder('-'),
                TextEntry::make('content.body')
                    ->label('Content Body')
                    ->columnSpanFull()
                    ->placeholder('-'),
            ]);
    }
}
