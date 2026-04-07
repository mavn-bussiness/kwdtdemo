<?php

namespace App\Filament\Resources\NewsletterSubscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsletterSubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Active Subscriber')
                    ->helperText('Uncheck to manually unsubscribe this address.')
                    ->columnSpanFull(),

                DateTimePicker::make('subscribed_at')
                    ->label('Subscribed At')
                    ->placeholder('—')
                    ->columnSpan(1),

                DateTimePicker::make('unsubscribed_at')
                    ->label('Unsubscribed At')
                    ->placeholder('—')
                    ->columnSpan(1),
            ]);
    }
}
