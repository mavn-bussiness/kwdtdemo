<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                    ->unique(ignoreRecord: true)
                    ->columnSpan(2),

                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation) => $operation === 'create')
                    ->minLength(8)
                    ->helperText('Minimum 8 characters. Leave blank to keep current password when editing.')
                    ->columnSpan(2),

                Select::make('role')
                    ->options([
                        'editor'      => 'Editor — can create & edit content only',
                        'admin'       => 'Admin — full access except user management',
                        'super_admin' => 'Super Admin — full access',
                    ])
                    ->required()
                    ->native(false)
                    ->columnSpan(2)
                    // Only super_admin can assign admin/super_admin roles
                    ->disableOptionWhen(fn (string $value): bool =>
                        in_array($value, ['admin', 'super_admin']) &&
                        ! auth()->user()?->isSuperAdmin()
                    ),
            ]);
    }
}
