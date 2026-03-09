<?php

namespace App\Filament\Resources\LaundryOrderBags\Pages;

use App\Filament\Resources\LaundryOrderBags\LaundryOrderBagResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryOrderBags extends ListRecords
{
    protected static string $resource = LaundryOrderBagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
