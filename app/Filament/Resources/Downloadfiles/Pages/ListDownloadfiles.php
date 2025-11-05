<?php

namespace App\Filament\Resources\Downloadfiles\Pages;

use App\Filament\Resources\Downloadfiles\DownloadfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDownloadfiles extends ListRecords
{
    protected static string $resource = DownloadfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
