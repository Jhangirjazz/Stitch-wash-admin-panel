<?php

namespace App\Filament\Resources\DriverLocations\Pages;

use App\Filament\Resources\DriverLocations\DriverLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDriverLocations extends ListRecords
{
    protected static string $resource = DriverLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
