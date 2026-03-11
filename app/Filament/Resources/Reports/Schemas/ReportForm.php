<?php

namespace App\Filament\Resources\Reports\Schemas;

use App\Models\Content;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Row 1: Link to content + Year
                Select::make('content_id')
                    ->label('Content Entry')
                    ->relationship('content', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(1),

                TextInput::make('report_year')
                    ->label('Report Year')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue((int) date('Y') + 1)
                    ->default((int) date('Y'))
                    ->columnSpan(1),

                // Row 2: File upload — autofill name, path, type, size
                FileUpload::make('file_path')
                    ->label('Report File (PDF / DOCX)')
                    ->required()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->directory('reports/'.date('Y'))
                    ->visibility('public')
                    ->downloadable()
                    ->afterStateUpdated(function (Set $set, mixed $state) {
                        // On edit, state may be a stored path string — only extract
                        // metadata when it's a fresh TemporaryUploadedFile
                        if (! $state instanceof TemporaryUploadedFile) {
                            return;
                        }
                        $set('file_name', $state->getClientOriginalName());
                        $set('file_type', $state->getClientMimeType());
                        $set('file_size_kb', (int) round($state->getSize() / 1024));
                    })
                    ->columnSpanFull(),

                // Row 3: Auto-filled metadata (read-only feel, but editable)
                TextInput::make('file_name')
                    ->label('File Name')
                    ->required()
                    ->helperText('Auto-filled on upload.')
                    ->columnSpan(1),

                TextInput::make('file_type')
                    ->label('File Type')
                    ->required()
                    ->helperText('Auto-filled on upload.')
                    ->columnSpan(1),

                TextInput::make('file_size_kb')
                    ->label('File Size (KB)')
                    ->numeric()
                    ->helperText('Auto-filled on upload.')
                    ->columnSpan(1),
            ])
            ->columns(2);
    }
}
