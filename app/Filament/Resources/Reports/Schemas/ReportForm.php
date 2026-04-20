<?php

namespace App\Filament\Resources\Reports\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ReportForm
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
                    ->unique('content', 'slug', ignoreRecord: true)
                    ->helperText('Auto-generated from title. You may customise it.')
                    ->columnSpan(1),

                Select::make('categories')
                    ->label('Categories')
                    ->options(fn () => Category::orderBy('name')->pluck('name', 'id'))
                    ->multiple()
                    ->searchable()
                    ->helperText('Thematic categories this report belongs to.')
                    ->columnSpan(1),

                Radio::make('publish_status')
                    ->label('Publish Status')
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

                DateTimePicker::make('published_at')
                    ->label('Published At')
                    ->nullable()
                    ->columnSpan(1),

                // ── Report-specific fields ────────────────────────────────────
                TextInput::make('report_year')
                    ->label('Report Year')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue((int) date('Y') + 1)
                    ->default((int) date('Y'))
                    ->columnSpan(1),

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
                        if (! $state instanceof TemporaryUploadedFile) {
                            return;
                        }
                        $set('file_name', $state->getClientOriginalName());
                        $set('file_type', $state->getClientMimeType());
                        $set('file_size_kb', (int) round($state->getSize() / 1024));
                    })
                    ->columnSpanFull(),

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
