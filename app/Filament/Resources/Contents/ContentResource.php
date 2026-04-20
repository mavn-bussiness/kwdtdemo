<?php

namespace App\Filament\Resources\Contents;

use App\Filament\Resources\Contents\Pages\CreateContent;
use App\Filament\Resources\Contents\Pages\EditContent;
use App\Filament\Resources\Contents\Pages\ListContents;
use App\Filament\Resources\Contents\Pages\ViewContent;
use App\Filament\Resources\Contents\Schemas\ContentForm;
use App\Filament\Resources\Contents\Schemas\ContentInfolist;
use App\Filament\Resources\Contents\Tables\ContentsTable;
use App\Models\Content;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentDuplicate;

    protected static string|null|\UnitEnum $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Posts & Pages';

    protected static ?string $recordTitleAttribute = 'title';

    protected static int $globalSearchResultsLimit = 5;

    public static function canAccess(): bool
    {
        $user = auth()->user();
        return $user?->isAdmin() || $user?->isEditor();
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();
        return $user?->isAdmin() || $user?->isEditor();
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery()->whereNotIn('type', ['event', 'project', 'report']);
        // Editors only see their own content
        if (auth()->user()?->isEditor()) {
            $query->where('author_id', auth()->id());
        }
        return $query;
    }

    public static function canEdit($record): bool
    {
        $user = auth()->user();
        if ($user?->isEditor()) {
            return $record->author_id === auth()->id();
        }
        return $user?->isAdmin() ?? false;
    }

    public static function canDelete($record): bool
    {
        $user = auth()->user();
        if ($user?->isEditor()) {
            return false; // editors cannot delete
        }
        return $user?->isAdmin() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return ContentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContentsTable::configure($table);
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
            'index' => ListContents::route('/'),
            'create' => CreateContent::route('/create'),
            'view' => ViewContent::route('/{record}'),
            'edit' => EditContent::route('/{record}/edit'),
        ];
    }
}
