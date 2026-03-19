<?php

namespace App\Filament\Resources\LaundryStainMarkers\Pages;

use App\Filament\Resources\LaundryStainMarkers\LaundryStainMarkerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryStainMarker extends EditRecord
{
    protected static string $resource = LaundryStainMarkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
