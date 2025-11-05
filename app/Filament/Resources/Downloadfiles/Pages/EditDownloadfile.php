<?php

namespace App\Filament\Resources\Downloadfiles\Pages;

use App\Filament\Resources\Downloadfiles\DownloadfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDownloadfile extends EditRecord
{
    protected static string $resource = DownloadfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
