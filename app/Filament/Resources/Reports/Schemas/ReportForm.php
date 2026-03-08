<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('content_id')
                    ->relationship('content', 'title')
                    ->required(),
                TextInput::make('file_name')
                    ->required(),
                TextInput::make('file_path')
                    ->required(),
                TextInput::make('file_type')
                    ->required(),
                TextInput::make('file_size_kb')
                    ->numeric()
                    ->default(null),
                TextInput::make('report_year')
                    ->required()
                    ->numeric(),
            ]);
    }
}
