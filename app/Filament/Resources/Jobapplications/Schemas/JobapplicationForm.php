<?php

namespace App\Filament\Resources\Jobapplications\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobapplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('job_listing_id')
                    ->relationship('jobListing', 'position')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                Textarea::make('cover_letter')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('cv_file_url')
                    ->label('CV / Resume')
                    ->disk('public')
                    ->directory('job-applications')
                    ->acceptedFileTypes(['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->required(),
            ]);
    }
}
