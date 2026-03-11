<?php

namespace App\Filament\Resources\Careers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CareerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Row 1: Title + Advert Number
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->columnSpan(1),

                TextInput::make('advert_number')
                    ->label('Advert Number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpan(1),

                // Row 2: Slug + Status
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Auto-generated from title.')
                    ->columnSpan(1),

                Select::make('status')
                    ->options(['open' => 'Open', 'closed' => 'Closed'])
                    ->default('open')
                    ->required()
                    ->columnSpan(1),

                // Row 3: Dates
                DateTimePicker::make('posted_at')
                    ->label('Posted At')
                    ->default(now())
                    ->required()
                    ->columnSpan(1),

                DateTimePicker::make('closed_at')
                    ->label('Closing Date')
                    ->nullable()
                    ->columnSpan(1),

                // Row 4: Active toggle
                Toggle::make('is_active')
                    ->label('Visible on website')
                    ->default(true)
                    ->columnSpan(2),

                // Row 5: PDF upload
                FileUpload::make('pdf_url')
                    ->label('Job Advert PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('careers/adverts')
                    ->visibility('public')
                    ->downloadable()
                    ->columnSpanFull(),

                // Row 6: Description
                RichEditor::make('description')
                    ->required()
                    ->toolbarButtons([
                        'bold', 'italic', 'underline',
                        'bulletList', 'orderedList',
                        'h2', 'h3',
                        'link',
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
