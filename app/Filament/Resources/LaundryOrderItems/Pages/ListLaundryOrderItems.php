<?php

namespace App\Filament\Resources\LaundryOrderItems\Pages;

use App\Filament\Resources\LaundryOrderItems\LaundryOrderItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryOrderItems extends ListRecords
{
    protected static string $resource = LaundryOrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
