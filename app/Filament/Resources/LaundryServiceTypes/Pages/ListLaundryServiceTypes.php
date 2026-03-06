<?php

namespace App\Filament\Resources\LaundryServiceTypes\Pages;

use App\Filament\Resources\LaundryServiceTypes\LaundryServiceTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryServiceTypes extends ListRecords
{
    protected static string $resource = LaundryServiceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
