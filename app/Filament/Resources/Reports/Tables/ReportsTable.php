<?php

namespace App\Filament\Resources\Reports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('report_year')
                    ->label('Year')
                    ->sortable(),

                TextColumn::make('content.title')
                    ->label('Title')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('file_name')
                    ->label('File')
                    ->searchable(),

                TextColumn::make('file_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => str_contains($state, 'pdf') ? 'danger' : 'info'),

                TextColumn::make('file_size_kb')
                    ->label('Size')
                    ->formatStateUsing(fn ($state) => $state ? $state.' KB' : '—'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('report_year', 'desc')
            ->filters([
                SelectFilter::make('report_year')
                    ->label('Year')
                    ->options(
                        \App\Models\Report::query()
                            ->distinct()
                            ->orderByDesc('report_year')
                            ->pluck('report_year', 'report_year')
                            ->toArray()
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
