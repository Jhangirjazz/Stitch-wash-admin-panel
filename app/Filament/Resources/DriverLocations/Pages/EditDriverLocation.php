<?php

namespace App\Filament\Resources\DriverLocations\Pages;

use App\Filament\Resources\DriverLocations\DriverLocationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDriverLocation extends EditRecord
{
    protected static string $resource = DriverLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
