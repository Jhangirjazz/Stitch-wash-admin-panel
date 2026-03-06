<?php

namespace App\Filament\Resources\SlotAvailabilities\Pages;

use App\Filament\Resources\SlotAvailabilities\SlotAvailabilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSlotAvailability extends EditRecord
{
    protected static string $resource = SlotAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
