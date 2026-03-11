<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamMembersInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('photo_url')
                            ->label('Photo')
                            ->circular()
                            ->columnSpanFull(),

                        TextEntry::make('name'),
                        TextEntry::make('title')->label('Job Title')->placeholder('—'),
                        TextEntry::make('email')->placeholder('—'),
                        IconEntry::make('is_active')->label('Active')->boolean(),
                        TextEntry::make('order')->label('Display Order')->numeric(),
                    ]),

                Section::make('Bio')
                    ->schema([
                        TextEntry::make('bio')
                            ->columnSpanFull()
                            ->placeholder('No bio provided'),
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
