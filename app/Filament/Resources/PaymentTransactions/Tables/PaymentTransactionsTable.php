<?php

namespace App\Filament\Resources\PaymentTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PaymentTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('gateway_ref')
                    ->label('Gateway Ref')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('donation.id')
                    ->label('Donation #')
                    ->sortable()
                    ->url(fn ($record) => route('filament.admin.resources.donations.view', $record->donation_id)),

                TextColumn::make('gateway')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paypal' => 'info',
                        default  => 'gray',
                    }),

                TextColumn::make('amount')
                    ->money(fn ($record) => $record->currency)
                    ->sortable(),

                TextColumn::make('currency')->toggleable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'success'   => 'success',
                        'pending'   => 'warning',
                        'failed'    => 'danger',
                        'cancelled' => 'gray',
                        default     => 'gray',
                    }),

                TextColumn::make('paid_at')
                    ->label('Paid At')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('—')
                    ->sortable(),
            ])
            ->defaultSort('paid_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'success'   => 'Success',
                        'failed'    => 'Failed',
                        'cancelled' => 'Cancelled',
                    ]),

                SelectFilter::make('gateway')
                    ->options([
                        'paypal' => 'PayPal',
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
