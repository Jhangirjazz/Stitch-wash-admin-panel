<?php

namespace App\Filament\Resources\LaundryOrders\Pages;

use App\Filament\Resources\LaundryOrders\LaundryOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryOrder extends EditRecord
{
    protected static string $resource = LaundryOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
