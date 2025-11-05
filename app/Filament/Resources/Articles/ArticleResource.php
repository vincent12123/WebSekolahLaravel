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

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')->relationship('author', 'name')->searchable()->preload(),
                Select::make('category_id')->relationship('category', 'name')->searchable()->preload(),
                TextInput::make('title')->required(),
                TextInput::make('slug')->helperText('Otomatis dari judul; bisa disesuaikan'),
                TextInput::make('excerpt')->maxLength(500),
                FileUpload::make('image_url')->image()->disk('public')->directory('articles')->preserveFilenames(),
                RichEditor::make('content')->required()->columnSpanFull(),
                Select::make('status')->options([
                    'published' => 'Published',
                    'draft' => 'Draft',
                    'archived' => 'Archived',
                ])->default('draft')->required(),
                DateTimePicker::make('published_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')->label('Image'),
                TextColumn::make('title')->searchable(),
                TextColumn::make('category.name')->label('Category')->searchable()->sortable(),
                BadgeColumn::make('status')->colors([
                    'success' => 'published',
                    'warning' => 'draft',
                    'danger' => 'archived',
                ]),
                TextColumn::make('published_at')->dateTime()->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'published' => 'Published',
                    'draft' => 'Draft',
                    'archived' => 'Archived',
                ]),
                SelectFilter::make('category_id')->label('Category')->relationship('category', 'name'),
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
