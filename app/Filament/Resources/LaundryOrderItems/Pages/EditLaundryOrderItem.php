<?php

namespace App\Filament\Resources\LaundryOrderItems\Pages;

use App\Filament\Resources\LaundryOrderItems\LaundryOrderItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryOrderItem extends EditRecord
{
    protected static string $resource = LaundryOrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
