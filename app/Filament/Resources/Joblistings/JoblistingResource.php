<?php

namespace App\Filament\Resources\Joblistings;

use App\Filament\Resources\Joblistings\Pages\CreateJoblisting;
use App\Filament\Resources\Joblistings\Pages\EditJoblisting;
use App\Filament\Resources\Joblistings\Pages\ListJoblistings;
use App\Filament\Resources\Joblistings\Schemas\JoblistingForm;
use App\Filament\Resources\Joblistings\Tables\JoblistingsTable;
use App\Models\JobListing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JoblistingResource extends Resource
{
    protected static ?string $model = JobListing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return JoblistingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JoblistingsTable::configure($table);
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
            'index' => ListJoblistings::route('/'),
            'create' => CreateJoblisting::route('/create'),
            'edit' => EditJoblisting::route('/{record}/edit'),
        ];
    }
}
