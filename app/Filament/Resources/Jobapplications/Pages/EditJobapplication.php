<?php

namespace App\Filament\Resources\Jobapplications\Pages;

use App\Filament\Resources\Jobapplications\JobapplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJobapplication extends EditRecord
{
    protected static string $resource = JobapplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
