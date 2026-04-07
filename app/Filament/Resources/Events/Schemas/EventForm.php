<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Content;
use App\Models\Event;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                // Only show content entries typed as 'event'
                Select::make('content_id')
                    ->label('Content Entry')
                    ->options(function ($record) {
                        $takenIds = Event::when(
                            $record,
                            fn ($q) => $q->where('id', '!=', $record->id)
                        )->pluck('content_id');

                        return Content::where('type', 'event')
                            ->whereNotIn('id', $takenIds)
                            ->orderBy('title')
                            ->pluck('title', 'id');
                    })
                    ->searchable()
                    ->required()
                    ->rules(fn ($record) => [
                        Rule::unique('events', 'content_id')
                            ->when($record, fn ($rule) => $rule->ignore($record->id)),
                    ])
                    ->validationMessages(['unique' => 'An event already exists for this content entry.'])
                    ->helperText('Only content entries with type "Event" are shown.')
                    ->columnSpanFull(),

                DateTimePicker::make('event_date')
                    ->label('Start Date & Time')
                    ->required()
                    ->columnSpan(1),

                DateTimePicker::make('end_date')
                    ->label('End Date & Time')
                    ->after('event_date')
                    ->columnSpan(1),

                TextInput::make('venue')
                    ->placeholder('e.g. Katosi Community Hall')
                    ->columnSpan(1),

                TextInput::make('district')
                    ->placeholder('e.g. Mukono')
                    ->columnSpan(1),

                TextInput::make('registration_url')
                    ->label('Registration URL')
                    ->url()
                    ->prefix('https://')
                    ->columnSpan(1),

                TextInput::make('capacity')
                    ->numeric()
                    ->minValue(1)
                    ->placeholder('Leave blank for unlimited')
                    ->columnSpan(1),
            ]);
    }
}
