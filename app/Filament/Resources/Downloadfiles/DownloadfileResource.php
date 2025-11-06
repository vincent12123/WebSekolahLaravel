<?php

namespace App\Filament\Resources\Downloadfiles;

use App\Filament\Resources\Downloadfiles\Pages\CreateDownloadfile;
use App\Filament\Resources\Downloadfiles\Pages\EditDownloadfile;
use App\Filament\Resources\Downloadfiles\Pages\ListDownloadfiles;
use App\Filament\Resources\Downloadfiles\Schemas\DownloadfileForm;
use App\Filament\Resources\Downloadfiles\Tables\DownloadfilesTable;
use App\Models\DownloadFile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DownloadfileResource extends Resource
{
    protected static ?string $model = DownloadFile::class;
    
    protected static ?string $navigationLabel = 'Berkas Unduhan';
    protected static UnitEnum|string|null $navigationGroup = 'Dokumen';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-down-tray';

    public static function form(Schema $schema): Schema
    {
        return DownloadfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DownloadfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDownloadfiles::route('/'),
            'create' => CreateDownloadfile::route('/create'),
            'edit' => EditDownloadfile::route('/{record}/edit'),
        ];
    }
}
