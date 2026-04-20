<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
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
                    ->helperText('Thematic categories this project belongs to.')
                    ->columnSpan(1),

                Radio::make('publish_status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
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
                    ->required()
                    ->columnSpanFull(),

                // ── Project-specific fields ───────────────────────────────────
                Select::make('status')
                    ->label('Project Status')
                    ->options(['planned' => 'Planned', 'ongoing' => 'Ongoing', 'completed' => 'Completed'])
                    ->default('planned')
                    ->required()
                    ->columnSpan(1),

                DatePicker::make('start_date')
                    ->required()
                    ->columnSpan(1),

                DatePicker::make('end_date')
                    ->after('start_date')
                    ->columnSpan(1),

                TextInput::make('location')
                    ->placeholder('e.g. Mukono District')
                    ->columnSpan(1),

                TextInput::make('funder')
                    ->placeholder('e.g. GIZ, EU Delegation')
                    ->columnSpan(1),

                TextInput::make('beneficiaries_count')
                    ->label('Beneficiaries Count')
                    ->numeric()
                    ->minValue(0)
                    ->columnSpan(1),

                TextInput::make('budget_usd')
                    ->label('Budget (USD)')
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0)
                    ->columnSpan(1),
            ])
            ->columns(2);
    }
}
