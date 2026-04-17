<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMembersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                // Row 1: Name (full width)
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),

                // Row 2: Job title + Email
                TextInput::make('title')
                    ->label('Job Title')
                    ->placeholder('e.g. Executive Director')
                    ->default(null)
                    ->columnSpan(1),

                TextInput::make('email')
                    ->email()
                    ->default(null)
                    ->columnSpan(1),

                // Row 3: Order + Active
                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower number = shown first')
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Visible on website')
                    ->default(true)
                    ->columnSpan(1),

                // Row 4: Photo upload
                FileUpload::make('photo_url')
                    ->label('Photo')
                    ->image()
                    ->disk('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->directory('team/photos')
                    ->visibility('public')
                    ->columnSpanFull(),

                // Row 5: Bio
                Textarea::make('bio')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }
}
