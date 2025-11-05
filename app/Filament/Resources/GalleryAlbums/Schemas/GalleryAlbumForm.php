<?php

namespace App\Filament\Resources\GalleryAlbums\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GalleryAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->helperText('Otomatis dari judul; bisa disesuaikan')
                    ->dehydrated(),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('cover_image_url')
                    ->image(),
                DatePicker::make('event_date'),
            ]);
    }
}
