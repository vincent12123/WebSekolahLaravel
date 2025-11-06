<?php

namespace App\Filament\Resources\Articles;

use App\Filament\Resources\Articles\Pages\CreateArticle;
use App\Filament\Resources\Articles\Pages\EditArticle;
use App\Filament\Resources\Articles\Pages\ListArticles;
use App\Models\Article;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    
    // Navigasi Filament (Bahasa Indonesia + ikon yang lebih relevan)
    protected static ?string $navigationLabel = 'Artikel';
    protected static UnitEnum|string|null $navigationGroup = 'Konten';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')->relationship('author', 'name')->searchable()->preload(),
                Select::make('category_id')->relationship('category', 'name')->searchable()->preload(),
                TextInput::make('title')->label('Judul')->required(),
                TextInput::make('slug')->helperText('Otomatis dari judul; bisa disesuaikan'),
                TextInput::make('excerpt')->label('Ringkasan')->maxLength(500),
                FileUpload::make('image_url')->label('Gambar')->image()->disk('public')->directory('articles')->preserveFilenames(),
                RichEditor::make('content')->label('Konten')->required()->columnSpanFull(),
                Select::make('status')->label('Status')->options([
                    'published' => 'Dipublikasikan',
                    'draft' => 'Draf',
                    'archived' => 'Diarsipkan',
                ])->default('draft')->required(),
                DateTimePicker::make('published_at')->label('Terbit Pada'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')->label('Gambar'),
                TextColumn::make('title')->label('Judul')->searchable(),
                TextColumn::make('category.name')->label('Kategori')->searchable()->sortable(),
                BadgeColumn::make('status')->colors([
                    'success' => 'published',
                    'warning' => 'draft',
                    'danger' => 'archived',
                ])->label('Status'),
                TextColumn::make('published_at')->label('Terbit')->dateTime()->sortable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Diperbarui')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->label('Status')->options([
                    'published' => 'Dipublikasikan',
                    'draft' => 'Draf',
                    'archived' => 'Diarsipkan',
                ]),
                SelectFilter::make('category_id')->label('Kategori')->relationship('category', 'name'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }
}
