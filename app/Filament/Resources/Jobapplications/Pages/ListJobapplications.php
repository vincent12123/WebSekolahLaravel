<?php

namespace App\Filament\Resources\Jobapplications\Pages;

use App\Filament\Resources\Jobapplications\JobapplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobapplications extends ListRecords
{
    protected static string $resource = JobapplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
