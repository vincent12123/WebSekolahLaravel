<?php

namespace App\Filament\Resources\Complaints;

use App\Filament\Resources\Complaints\Pages\CreateComplaint;
use App\Filament\Resources\Complaints\Pages\EditComplaint;
use App\Filament\Resources\Complaints\Pages\ListComplaints;
use App\Models\Complaint;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;
    
    protected static ?string $navigationLabel = 'Pengaduan';
    protected static UnitEnum|string|null $navigationGroup = 'Layanan';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nama'),
                TextInput::make('email')->label('Email')->email(),
                TextInput::make('category')->label('Kategori')->required(),
                TextInput::make('subject')->label('Subjek')->required(),
                Textarea::make('message')->label('Pesan')->required()->columnSpanFull(),
                Select::make('status')->label('Status')->options([
                    'new' => 'Baru',
                    'in_progress' => 'Diproses',
                    'resolved' => 'Selesai',
                ])->default('new'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category')->searchable(),
                TextColumn::make('subject')->searchable(),
                TextColumn::make('email')->searchable(),
                BadgeColumn::make('status')->colors([
                    'warning' => 'new',
                    'info' => 'in_progress',
                    'success' => 'resolved',
                ])->label('Status'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->label('Status')->options([
                    'new' => 'Baru',
                    'in_progress' => 'Diproses',
                    'resolved' => 'Selesai',
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComplaints::route('/'),
            'create' => CreateComplaint::route('/create'),
            'edit' => EditComplaint::route('/{record}/edit'),
        ];
    }
}
