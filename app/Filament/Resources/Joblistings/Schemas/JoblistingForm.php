<?php

namespace App\Filament\Resources\Joblistings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JoblistingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('position')
                    ->required(),
                TextInput::make('job_type'),
                TextInput::make('location'),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('requirements')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('deadline'),
                Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'closed' => 'Closed',
                    ])
                    ->required()
                    ->default('open'),
            ]);
    }
}
