<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\Pages\CreateEvent;
use App\Filament\Resources\Events\Pages\EditEvent;
use App\Filament\Resources\Events\Pages\ListEvents;
use App\Models\Event;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
// use Filament\Support\Icons\Heroicon; // not used directly
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationLabel = 'Event';
    protected static UnitEnum|string|null $navigationGroup = 'Konten';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Judul')->required(),
                TextInput::make('slug')->label('Slug')->helperText('Biarkan kosong untuk otomatis') ,
                RichEditor::make('description')->label('Deskripsi')->columnSpanFull(),
                DateTimePicker::make('starts_at')->label('Mulai')->required(),
                DateTimePicker::make('ends_at')->label('Selesai'),
                TextInput::make('location')->label('Lokasi'),
                FileUpload::make('image_url')->label('Gambar')->image()->disk('public')->directory('events')->preserveFilenames(),
                Select::make('status')->label('Status')->options([
                    'scheduled' => 'Dijadwalkan',
                    'cancelled' => 'Dibatalkan',
                    'completed' => 'Selesai',
                ])->default('scheduled')->required(),
                DateTimePicker::make('published_at')->label('Dipublikasikan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')->label('Gambar'),
                TextColumn::make('title')->label('Judul')->searchable(),
                TextColumn::make('starts_at')->label('Mulai')->dateTime()->sortable(),
                TextColumn::make('location')->label('Lokasi')->searchable(),
                TextColumn::make('status')->label('Status')->badge(),
            ])
            ->filters([
                SelectFilter::make('status')->label('Status')->options([
                    'scheduled' => 'Dijadwalkan',
                    'cancelled' => 'Dibatalkan',
                    'completed' => 'Selesai',
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}
