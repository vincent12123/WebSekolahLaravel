<?php

namespace App\Filament\Resources\Joblistings\Pages;

use App\Filament\Resources\Joblistings\JoblistingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJoblisting extends EditRecord
{
    protected static string $resource = JoblistingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
