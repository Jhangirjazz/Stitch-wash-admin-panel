<?php

namespace App\Filament\Resources\LaundryItems\Pages;

use App\Filament\Resources\LaundryItems\LaundryItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryItems extends ListRecords
{
    protected static string $resource = LaundryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
