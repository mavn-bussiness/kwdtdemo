<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMembersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpan(2),
                TextInput::make('title')
                    ->default(null),
                TextInput::make('email')
                    ->email()
                    ->default(null),
                TextInput::make('photo_url')
                    ->url()
                    ->default(null),
                Textarea::make('bio')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
