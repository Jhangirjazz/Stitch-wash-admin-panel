<?php

namespace App\Filament\Resources\LaundryOrders\Pages;

use App\Filament\Resources\LaundryOrders\LaundryOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryOrders extends ListRecords
{
    protected static string $resource = LaundryOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
