<?php

namespace App\Filament\Resources\Comments;

use App\Filament\Resources\Comments\Pages\CreateComment;
use App\Filament\Resources\Comments\Pages\EditComment;
use App\Filament\Resources\Comments\Pages\ListComments;
use App\Models\Comment;
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

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    
    protected static ?string $navigationLabel = 'Komentar';
    protected static UnitEnum|string|null $navigationGroup = 'Interaksi';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('article_id')->label('Artikel')->relationship('article', 'title')->searchable()->required(),
                Select::make('parent_id')->label('Induk')->relationship('parent', 'id')->searchable(),
                TextInput::make('sender_name')->label('Nama')->required(),
                TextInput::make('sender_email')->label('Email')->email()->required(),
                Textarea::make('content')->label('Isi Komentar')->required()->columnSpanFull(),
                Select::make('status')->label('Status')->options([
                    'pending' => 'Tertunda',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                ])->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('article.title')->label('Artikel')->searchable()->sortable(),
                TextColumn::make('sender_name')->label('Nama')->searchable(),
                TextColumn::make('sender_email')->label('Email')->searchable(),
                BadgeColumn::make('status')->colors([
                    'warning' => 'pending',
                    'success' => 'approved',
                    'danger' => 'rejected',
                ])->label('Status'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->label('Status')->options([
                    'pending' => 'Tertunda',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComments::route('/'),
            'create' => CreateComment::route('/create'),
            'edit' => EditComment::route('/{record}/edit'),
        ];
    }
}
