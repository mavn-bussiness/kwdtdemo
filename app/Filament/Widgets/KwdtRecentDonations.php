<?php

namespace App\Filament\Widgets;

use App\Models\PaymentTransaction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class KwdtRecentDonations extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Recent Donations';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => PaymentTransaction::query()->with('donation')->latest('paid_at'))
            ->columns([
                TextColumn::make('gateway_ref')
                    ->label('Transaction ID')
                    ->searchable(),

                TextColumn::make('donation.donor_name')
                    ->label('Donor')
                    ->formatStateUsing(fn ($record) => $record->donation?->is_anonymous ? 'Anonymous' : ($record->donation?->donor_name ?? 'Anonymous')),

                TextColumn::make('amount')
                    ->money(fn ($record) => $record->currency)
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('paid_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
            ]);
    }
}
