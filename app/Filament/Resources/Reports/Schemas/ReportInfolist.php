<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Report Details')
                    ->columns(2)
                    ->schema([
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

                        TextEntry::make('report_year')
                            ->label('Report Year'),

                        TextEntry::make('content.categories.name')
                            ->label('Categories')
                            ->badge()
                            ->separator(','),

                        TextEntry::make('file_name')
                            ->label('File Name'),

                        TextEntry::make('file_type')
                            ->label('File Type'),

                        TextEntry::make('file_size_kb')
                            ->label('File Size')
                            ->formatStateUsing(fn ($state) => $state ? $state.' KB' : '—'),

                        TextEntry::make('file_path')
                            ->label('Download')
                            ->formatStateUsing(fn ($state) => $state ? basename($state) : '—')
                            ->url(fn ($record) => $record->file_path ? asset('storage/'.$record->file_path) : null)
                            ->openUrlInNewTab(),
                    ]),

                Section::make('Timestamps')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('created_at')->dateTime(),
                        TextEntry::make('updated_at')->dateTime(),
                    ]),
            ]);
    }
}
