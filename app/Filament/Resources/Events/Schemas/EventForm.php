<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) =>
                        $set('slug', $state ? Str::slug($state) : '')
                    )
                    ->columnSpan(1),

                TextInput::make('slug')
                    ->required()
                    ->unique('content', 'slug', ignoreRecord: true)
                    ->helperText('Auto-generated from title. You may customise it.')
                    ->columnSpan(1),

                Select::make('categories')
                    ->label('Categories')
                    ->options(fn () => Category::orderBy('name')->pluck('name', 'id'))
                    ->multiple()
                    ->searchable()
                    ->columnSpan(1),

                Radio::make('publish_status')
                    ->label('Publish Status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])
                    ->default('draft')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        if ($state === 'published') {
                            $set('published_at', now()->toDateTimeString());
                        }
                    })
                    ->inline()
                    ->columnSpan(1),

                DateTimePicker::make('published_at')
                    ->label('Published At')
                    ->nullable()
                    ->columnSpan(1),

                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->disk('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->directory('content/images')
                    ->visibility('public')
                    ->columnSpanFull(),

                RichEditor::make('excerpt')
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('Content Body')
                    ->columnSpanFull(),

                // ── Event-specific fields ─────────────────────────────────────
                DateTimePicker::make('event_date')
                    ->label('Start Date & Time')
                    ->required()
                    ->columnSpan(1),

                DateTimePicker::make('end_date')
                    ->label('End Date & Time')
                    ->after('event_date')
                    ->columnSpan(1),

                TextInput::make('venue')
                    ->placeholder('e.g. Katosi Community Hall')
                    ->columnSpan(1),

                TextInput::make('district')
                    ->placeholder('e.g. Mukono')
                    ->columnSpan(1),

                TextInput::make('registration_url')
                    ->label('Registration URL')
                    ->url()
                    ->prefix('https://')
                    ->columnSpan(1),

                TextInput::make('capacity')
                    ->numeric()
                    ->minValue(1)
                    ->placeholder('Leave blank for unlimited')
                    ->columnSpan(1),
            ]);
    }
}
