<?php

namespace App\Filament\Resources\LaundryServiceTypes\Pages;

use App\Filament\Resources\LaundryServiceTypes\LaundryServiceTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryServiceType extends EditRecord
{
    protected static string $resource = LaundryServiceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
