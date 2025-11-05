<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('file_attachment_url')
                    ->label('Attachment')
                    ->directory('announcements')
                    ->disk('public')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->acceptedFileTypes(['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','image/*'])
                    ->downloadable()
                    ->openable(),
                Toggle::make('is_important')
                    ->required(),
                DateTimePicker::make('published_at')
                    ->default(now())
                    ->required(),
            ]);
    }
}
