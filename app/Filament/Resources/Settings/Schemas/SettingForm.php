<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_sekolah')
                    ->required()
                    ->default('Portal Sekolah'),
                TextInput::make('logo_url')
                    ->url(),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('telepon')
                    ->tel(),
                TextInput::make('email_kontak')
                    ->email(),
                TextInput::make('link_facebook'),
                TextInput::make('link_instagram'),
                TextInput::make('link_youtube'),
            ]);
    }
}
