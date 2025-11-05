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

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('email')->email(),
                TextInput::make('category')->required(),
                TextInput::make('subject')->required(),
                Textarea::make('message')->required()->columnSpanFull(),
                Select::make('status')->options([
                    'new' => 'New',
                    'in_progress' => 'In Progress',
                    'resolved' => 'Resolved',
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
                ]),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'new' => 'New',
                    'in_progress' => 'In Progress',
                    'resolved' => 'Resolved',
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
