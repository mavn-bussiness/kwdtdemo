<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content.title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('content.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft'     => 'warning',
                        'archived'  => 'danger',
                        default     => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('content.categories.name')
                    ->label('Categories')
                    ->badge()
                    ->separator(','),
                TextColumn::make('event_date')
                    ->label('Start')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('End')
                    ->dateTime('d M Y H:i')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('venue')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('district')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('capacity')
                    ->numeric()
                    ->placeholder('Unlimited')
                    ->sortable(),
                TextColumn::make('content.published_at')
                    ->label('Published')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('content.author.name')
                    ->label('Author')
                    ->placeholder('—')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('content.status')
                    ->label('Status')
                    ->relationship('content', 'status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived']),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('event_date', 'asc');
    }
}
