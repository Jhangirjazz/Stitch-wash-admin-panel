<?php

namespace App\Filament\Resources\LaundryOrderBags\Pages;

use App\Filament\Resources\LaundryOrderBags\LaundryOrderBagResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryOrderBag extends EditRecord
{
    protected static string $resource = LaundryOrderBagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
