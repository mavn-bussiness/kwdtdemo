<?php

namespace App\Filament\Resources\Partners;

use App\Filament\Resources\Partners\Pages\CreatePartners;
use App\Filament\Resources\Partners\Pages\EditPartners;
use App\Filament\Resources\Partners\Pages\ListPartners;
use App\Filament\Resources\Partners\Pages\ViewPartners;
use App\Filament\Resources\Partners\Schemas\PartnersForm;
use App\Filament\Resources\Partners\Schemas\PartnersInfolist;
use App\Filament\Resources\Partners\Tables\PartnersTable;
use App\Models\Partner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnersResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static string|null|\UnitEnum $navigationGroup = 'Organisation';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Partners';

    protected static ?string $recordTitleAttribute = 'name';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return PartnersForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PartnersInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnersTable::configure($table);
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
            'index' => ListPartners::route('/'),
            'create' => CreatePartners::route('/create'),
            'view' => ViewPartners::route('/{record}'),
            'edit' => EditPartners::route('/{record}/edit'),
        ];
    }
}
