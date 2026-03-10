<?php

namespace App\Filament\Resources\TailorMeasurements\Pages;

use App\Filament\Resources\TailorMeasurements\TailorMeasurementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTailorMeasurement extends EditRecord
{
    protected static string $resource = TailorMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
