<?php

namespace App\Filament\Resources\LaundryItems\Pages;

use App\Filament\Resources\LaundryItems\LaundryItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryItem extends EditRecord
{
    protected static string $resource = LaundryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
