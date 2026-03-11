<?php

namespace App\Filament\Resources\TeamMembers;

use App\Filament\Resources\TeamMembers\Pages\CreateTeamMembers;
use App\Filament\Resources\TeamMembers\Pages\EditTeamMembers;
use App\Filament\Resources\TeamMembers\Pages\ListTeamMembers;
use App\Filament\Resources\TeamMembers\Pages\ViewTeamMembers;
use App\Filament\Resources\TeamMembers\Schemas\TeamMembersForm;
use App\Filament\Resources\TeamMembers\Schemas\TeamMembersInfolist;
use App\Filament\Resources\TeamMembers\Tables\TeamMembersTable;
use App\Models\TeamMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TeamMembersResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|null|\UnitEnum $navigationGroup = 'Organisation';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Team Members';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TeamMembersForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TeamMembersInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeamMembersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeamMembers::route('/'),
            'create' => CreateTeamMembers::route('/create'),
            'view' => ViewTeamMembers::route('/{record}'),
            'edit' => EditTeamMembers::route('/{record}/edit'),
        ];
    }
}
