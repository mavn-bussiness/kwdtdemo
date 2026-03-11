<?php

namespace App\Filament\Resources\Donations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('donor_name')
                    ->label('Donor')
                    ->default('Anonymous')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('donor_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('amount_original')
                    ->label('Amount')
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) => $record->currency . ' ' . number_format($state, 2)),

                TextColumn::make('amount_usd')
                    ->label('USD Equiv.')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('payment_method')
                    ->label('Method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paypal'       => 'info',
                        'mtn_momo'     => 'warning',
                        'airtel_money' => 'danger',
                        default        => 'gray',
                    }),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'failed'  => 'danger',
                        default   => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'failed'  => 'Failed',
                    ]),

                SelectFilter::make('payment_method')
                    ->label('Method')
                    ->options([
                        'paypal'       => 'PayPal',
                        'mtn_momo'     => 'MTN MoMo',
                        'airtel_money' => 'Airtel Money',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
