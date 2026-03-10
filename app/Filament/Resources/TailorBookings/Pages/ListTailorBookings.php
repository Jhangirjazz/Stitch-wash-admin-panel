<?php

namespace App\Filament\Resources\TailorBookings\Pages;

use App\Filament\Resources\TailorBookings\TailorBookingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTailorBookings extends ListRecords
{
    protected static string $resource = TailorBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
