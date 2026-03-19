<?php

namespace App\Filament\Resources\LaundryStainMarkers\Pages;

use App\Filament\Resources\LaundryStainMarkers\LaundryStainMarkerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryStainMarkers extends ListRecords
{
    protected static string $resource = LaundryStainMarkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
