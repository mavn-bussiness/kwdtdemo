<?php

namespace App\Filament\Resources\Contents\Schemas;

use App\Models\Category;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required(),
                TextInput::make('slug')->required(),
                Select::make('category_id')->options(Category::all()->pluck('name', 'id'))->required()->label('Category'),
                MarkdownEditor::make('excerpt')->columnSpanFull(),
                MarkdownEditor::make('content')->required()->columnSpanFull(),
                Radio::make('status')->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])->default('draft')->required(),
                TextInput::make('image_url')->required()->url(),

            ])->columns(2);
    }
}
