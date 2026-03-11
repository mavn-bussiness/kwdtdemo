<?php

namespace App\Filament\Resources\TeamMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TeamMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_url')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(asset('images/placeholder-avatar.png')),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Job Title')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('email')
                    ->searchable()
                    ->placeholder('—')
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->filters([
                TernaryFilter::make('is_active')->label('Active'),
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
