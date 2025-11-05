<?php

namespace App\Filament\Resources\Jobapplications;

use App\Filament\Resources\Jobapplications\Pages\CreateJobapplication;
use App\Filament\Resources\Jobapplications\Pages\EditJobapplication;
use App\Filament\Resources\Jobapplications\Pages\ListJobapplications;
use App\Filament\Resources\Jobapplications\Schemas\JobapplicationForm;
use App\Filament\Resources\Jobapplications\Tables\JobapplicationsTable;
use App\Models\JobApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobapplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return JobapplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobapplicationsTable::configure($table);
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
            'index' => ListJobapplications::route('/'),
            'create' => CreateJobapplication::route('/create'),
            'edit' => EditJobapplication::route('/{record}/edit'),
        ];
    }
}
