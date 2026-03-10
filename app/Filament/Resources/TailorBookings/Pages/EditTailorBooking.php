<?php

namespace App\Filament\Resources\TailorBookings\Pages;

use App\Filament\Resources\TailorBookings\TailorBookingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTailorBooking extends EditRecord
{
    protected static string $resource = TailorBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
