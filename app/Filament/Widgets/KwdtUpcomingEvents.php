<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class KwdtUpcomingEvents extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = 'Upcoming Events';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Event::query()
                    ->with('content')
                    ->where('event_date', '>=', now())
                    ->orderBy('event_date')
            )
            ->columns([
                TextColumn::make('event_date')
                    ->label('Date')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('content.title')
                    ->label('Event')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('venue')
                    ->label('Venue')
                    ->placeholder('TBC'),

                TextColumn::make('district')
                    ->label('District')
                    ->placeholder('—'),

                TextColumn::make('capacity')
                    ->label('Capacity')
                    ->placeholder('Unlimited'),
            ])
            ->paginated([6, 10, 25]);
    }
}
