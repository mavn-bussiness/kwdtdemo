<?php

namespace App\Filament\Resources\Awards\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AwardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('awarding_organization')
                    ->label('Awarding Organisation')
                    ->placeholder('e.g. UN Women, Government of Uganda')
                    ->columnSpan(1),

                TextInput::make('year')
                    ->required()
                    ->numeric()
                    ->minValue(1990)
                    ->maxValue((int) date('Y'))
                    ->default((int) date('Y'))
                    ->columnSpan(1),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('image_url')
                    ->label('Award Image / Certificate')
                    ->image()
                    ->disk('public')
                    ->directory('awards/images')
                    ->visibility('public')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower = shown first')
                    ->columnSpan(1),
            ]);
    }
}
