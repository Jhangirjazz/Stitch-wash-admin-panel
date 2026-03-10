<?php

namespace App\Filament\Resources\TailorMeasurements\Pages;

use App\Filament\Resources\TailorMeasurements\TailorMeasurementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTailorMeasurements extends ListRecords
{
    protected static string $resource = TailorMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
