<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('content.title')
                    ->label('Content'),
                TextEntry::make('file_name'),
                TextEntry::make('file_path'),
                TextEntry::make('file_type'),
                TextEntry::make('file_size_kb')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('report_year')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
