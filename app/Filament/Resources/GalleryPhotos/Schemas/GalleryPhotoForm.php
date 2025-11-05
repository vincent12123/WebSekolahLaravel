<?php

namespace App\Filament\Resources\GalleryPhotos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('gallery_album_id')
                    ->relationship('album', 'title')
                    ->required(),
                FileUpload::make('file_url')
                    ->label('Photo')
                    ->image()
                    ->disk('public')
                    ->directory('gallery')
                    ->preserveFilenames()
                    ->required()
                    ->downloadable()
                    ->openable(),
                TextInput::make('description'),
            ]);
    }
}
