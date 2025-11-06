<?php

namespace App\Filament\Resources\Extracurriculars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ExtracurricularForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                FileUpload::make('logo_url')
                    ->label('Logo (Upload)')
                    ->image()
                    ->disk('public')
                    ->directory('extracurriculars')
                    ->preserveFilenames(),
                TextInput::make('logo_url_external')
                    ->label('URL Logo (Unsplash/External)')
                    ->url()
                    ->helperText('Atau pilih gambar dari Unsplash lewat tombol di atas.'),
                TextInput::make('instructor_name'),
                TextInput::make('schedule'),
                RichEditor::make('description')
                    ->columnSpanFull(),
                Select::make('gallery_album_id')
                    ->relationship('galleryAlbum', 'title')
                    ->searchable()
                    ->preload(),
            ]);
    }
}
