<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->label('Person\'s Name')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('community')
                    ->label('Community / Location')
                    ->placeholder('e.g. Katosi Landing Site, Mukono')
                    ->columnSpan(1),

                Textarea::make('quote')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                FileUpload::make('photo_url')
                    ->label('Photo')
                    ->image()
                    ->disk('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->directory('testimonials/photos')
                    ->visibility('public')
                    ->columnSpan(1),

                Toggle::make('is_featured')
                    ->label('Show on homepage')
                    ->default(false)
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower = shown first')
                    ->columnSpan(1),
            ]);
    }
}
