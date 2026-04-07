<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('content.title')
                    ->label('Title')
                    ->columnSpanFull(),

                TextEntry::make('content.status')
                    ->label('Publish Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'gray',
                        default => 'gray',
                    }),

                TextEntry::make('status')
                    ->label('Project Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'planned' => 'info',
                        'ongoing' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    }),

                TextEntry::make('start_date')->date('d M Y'),
                TextEntry::make('end_date')->date('d M Y')->placeholder('—'),
                TextEntry::make('location')->placeholder('—'),
                TextEntry::make('funder')->placeholder('—'),

                TextEntry::make('beneficiaries_count')
                    ->label('Beneficiaries')
                    ->numeric()
                    ->placeholder('—'),

                TextEntry::make('budget_usd')
                    ->label('Budget (USD)')
                    ->money('USD')
                    ->placeholder('—'),

                TextEntry::make('content.categories.name')
                    ->label('Categories')
                    ->badge()
                    ->separator(','),

                TextEntry::make('content.excerpt')
                    ->label('Excerpt')
                    ->placeholder('—')
                    ->columnSpanFull(),

                TextEntry::make('content.body')
                    ->label('Body')
                    ->markdown()
                    ->columnSpanFull(),

                ImageEntry::make('content.featured_image')
                    ->label('Featured Image')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
