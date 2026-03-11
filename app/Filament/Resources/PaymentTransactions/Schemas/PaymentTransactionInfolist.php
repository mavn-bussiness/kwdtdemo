<?php

namespace App\Filament\Resources\PaymentTransactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentTransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Transaction Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('gateway_ref')
                            ->label('Gateway Reference')
                            ->copyable(),

                        TextEntry::make('gateway')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'paypal'       => 'info',
                                'mtn_momo'     => 'warning',
                                'airtel_money' => 'danger',
                                default        => 'gray',
                            }),

                        TextEntry::make('amount')
                            ->money(fn ($record) => $record->currency),

                        TextEntry::make('currency'),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'success'   => 'success',
                                'pending'   => 'warning',
                                'failed'    => 'danger',
                                'cancelled' => 'gray',
                                default     => 'gray',
                            }),

                        TextEntry::make('paid_at')
                            ->label('Paid At')
                            ->dateTime('d M Y, H:i')
                            ->placeholder('Not yet paid'),
                    ]),

                Section::make('Linked Donation')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('donation.id')->label('Donation ID'),
                        TextEntry::make('donation.donor_name')->label('Donor')->default('Anonymous'),
                        TextEntry::make('donation.donor_email')->label('Email')->default('—'),
                        TextEntry::make('donation.payment_method')->label('Payment Method')->badge(),
                    ]),

                Section::make('Raw Gateway Response')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('raw_response')
                            ->label('')
                            ->columnSpanFull()
                            ->placeholder('No response data')
                            ->formatStateUsing(fn ($state) => is_array($state)
                                ? json_encode($state, JSON_PRETTY_PRINT)
                                : $state),
                    ]),
            ]);
    }
}
