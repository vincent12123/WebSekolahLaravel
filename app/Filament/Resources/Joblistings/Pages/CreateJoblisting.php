<?php

namespace App\Filament\Resources\Joblistings\Pages;

use App\Filament\Resources\Joblistings\JoblistingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJoblisting extends CreateRecord
{
    protected static string $resource = JoblistingResource::class;
}
