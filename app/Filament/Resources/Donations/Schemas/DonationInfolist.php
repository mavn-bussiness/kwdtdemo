<?php

namespace App\Filament\Resources\Donations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DonationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Donor Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('donor_name')
                            ->label('Name')
                            ->default('Anonymous'),

                        TextEntry::make('donor_email')
                            ->label('Email')
                            ->default('—'),

                        TextEntry::make('donor_phone')
                            ->label('Phone')
                            ->default('—'),

                        TextEntry::make('is_anonymous')
                            ->label('Anonymous Donation?')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Yes' : 'No'),

                        TextEntry::make('reason')
                            ->label('Donor Message')
                            ->columnSpanFull()
                            ->placeholder('No message provided'),
                    ]),

                Section::make('Payment Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('amount_original')
                            ->label('Amount Paid')
                            ->formatStateUsing(fn ($state, $record) => $record->currency . ' ' . number_format($state, 2)),

                        TextEntry::make('amount_usd')
                            ->label('USD Equivalent')
                            ->money('USD')
                            ->placeholder('—'),

                        TextEntry::make('currency')
                            ->label('Currency'),

                        TextEntry::make('payment_method')
                            ->label('Payment Method')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'paypal'       => 'info',
                                'mtn_momo'     => 'warning',
                                'airtel_money' => 'danger',
                                default        => 'gray',
                            }),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'success' => 'success',
                                'pending' => 'warning',
                                'failed'  => 'danger',
                                default   => 'gray',
                            }),

                        TextEntry::make('created_at')
                            ->label('Donated At')
                            ->dateTime('d M Y, H:i'),
                    ]),

                Section::make('Transaction Records')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('transactions.gateway_ref')
                            ->label('Gateway Reference')
                            ->placeholder('—'),

                        TextEntry::make('transactions.gateway')
                            ->label('Gateway')
                            ->placeholder('—'),

                        TextEntry::make('transactions.status')
                            ->label('Transaction Status')
                            ->badge()
                            ->placeholder('—'),

                        TextEntry::make('transactions.paid_at')
                            ->label('Paid At')
                            ->dateTime('d M Y, H:i')
                            ->placeholder('—'),
                    ]),
            ]);
    }
}
