<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('content_id')
                    ->relationship('content', 'title')
                    ->required(),
                DateTimePicker::make('event_date')
                    ->required(),
                DateTimePicker::make('end_date'),
                TextInput::make('venue')
                    ->default(null),
                TextInput::make('district')
                    ->default(null),
                TextInput::make('registration_url')
                    ->url()
                    ->default(null),
                TextInput::make('capacity')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
