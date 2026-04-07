<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PartnersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('website')
                    ->url()
                    ->prefix('https://')
                    ->placeholder('www.example.org')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower = shown first')
                    ->columnSpan(1),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Visible on website')
                    ->default(true)
                    ->columnSpan(1),

                // Logo upload — stored in storage/app/public/partners/logos
                FileUpload::make('logo_url')
                    ->label('Partner Logo')
                    ->image()
                    ->imageResizeMode('contain')
                    ->directory('partners/logos')
                    ->visibility('public')
                    ->helperText('PNG or SVG with transparent background recommended.')
                    ->columnSpanFull(),
            ]);
    }
}
