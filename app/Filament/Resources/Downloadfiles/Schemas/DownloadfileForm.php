<?php

namespace App\Filament\Resources\Downloadfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DownloadfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('download_category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                FileUpload::make('file_path')
                    ->disk('public')
                    ->directory('downloads')
                    ->preserveFilenames()
                    ->required()
                    ->acceptedFileTypes(['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','image/*'])
                    ->downloadable()
                    ->openable(),
                TextInput::make('file_type')->disabled(),
                TextInput::make('file_size_kb')->numeric()->disabled(),
            ]);
    }
}
