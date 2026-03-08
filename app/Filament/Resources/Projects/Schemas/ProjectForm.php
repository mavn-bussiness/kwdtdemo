<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('content_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                TextInput::make('location')
                    ->default(null),
                Select::make('status')
                    ->options(['planned' => 'Planned', 'ongoing' => 'Ongoing', 'completed' => 'Completed'])
                    ->default('planned')
                    ->required(),
                TextInput::make('beneficiaries_count')
                    ->numeric()
                    ->default(null),
                TextInput::make('funder')
                    ->default(null),
                TextInput::make('budget_usd')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
