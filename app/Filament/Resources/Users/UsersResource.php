<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUsers;
use App\Filament\Resources\Users\Pages\EditUsers;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUsers;
use App\Filament\Resources\Users\Schemas\UsersForm;
use App\Filament\Resources\Users\Schemas\UsersInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static string|null|\UnitEnum $navigationGroup = 'Community';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Admin Users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canEdit($record): bool
    {
        $user = auth()->user();
        // Only super_admin can edit other admins/super_admins
        if (in_array($record->role, ['admin', 'super_admin'])) {
            return $user?->isSuperAdmin() ?? false;
        }
        return $user?->isAdmin() ?? false;
    }

    public static function canDelete($record): bool
    {
        // Cannot delete yourself
        if ($record->id === auth()->id()) return false;
        // Only super_admin can delete admins
        if (in_array($record->role, ['admin', 'super_admin'])) {
            return auth()->user()?->isSuperAdmin() ?? false;
        }
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return UsersForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UsersInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUsers::route('/create'),
            'view' => ViewUsers::route('/{record}'),
            'edit' => EditUsers::route('/{record}/edit'),
        ];
    }
}
