<?php

namespace App\Filament\Resources\TailorServices\Pages;

use App\Filament\Resources\TailorServices\TailorServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTailorService extends EditRecord
{
    protected static string $resource = TailorServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
