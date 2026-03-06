<?php

namespace App\Filament\Resources\SlotAvailabilities\Pages;

use App\Filament\Resources\SlotAvailabilities\SlotAvailabilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSlotAvailabilities extends ListRecords
{
    protected static string $resource = SlotAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
