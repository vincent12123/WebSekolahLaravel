<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
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
                TextInput::make('nama_kepala_sekolah')
                    ->label('Nama Kepala Sekolah')
                    ->placeholder('Ignasius Asong, S.Pd, MAT'),
                TextInput::make('logo_url')
                    ->url(),
                FileUpload::make('foto_kepala_sekolah_url')
                    ->label('Foto Kepala Sekolah')
                    ->image()
                    ->disk('public')
                    ->directory('images')
                    ->imageEditor()
                    ->imageResizeMode('contain')
                    ->imageCropAspectRatio('1:1')
                    ->helperText('Opsional. Jika kosong akan memakai placeholder.'),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                Textarea::make('sambutan_kepala_sekolah')
                    ->label('Sambutan Kepala Sekolah')
                    ->rows(5)
                    ->columnSpanFull()
                    ->placeholder("Selamat datang di website resmi SMPN 2 Sintang. Melalui platform ini, kami berkomitmen menghadirkan informasi yang akurat, transparan, dan bermanfaat bagi siswa, orang tua, guru, dan seluruh pemangku kepentingan. Semoga website ini dapat menjadi jembatan komunikasi serta sarana literasi digital yang mendorong prestasi dan karakter peserta didik."),
                Textarea::make('jam_operasional')
                    ->label('Jam Operasional')
                    ->placeholder('Senin - Jumat, 08.00 - 16.00')
                    ->rows(2)
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
