<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpan(2),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->columnSpan(2),

                TextInput::make('password')
                    ->password()
                    ->required()
                    ->columnSpan(2),

                Select::make('role')
                    ->options([
                        'user' => 'User',
                        'admin' => 'Admin',
                        'super_admin' => 'Super Admin',
                    ])
                    ->required(),

                Toggle::make('email_verified')
                    ->label('Email Verified')
                    ->default(false),
            ]);
    }
}
