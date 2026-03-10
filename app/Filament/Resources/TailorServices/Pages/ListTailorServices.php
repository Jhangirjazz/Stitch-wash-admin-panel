<?php

namespace App\Filament\Resources\TailorServices\Pages;

use App\Filament\Resources\TailorServices\TailorServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTailorServices extends ListRecords
{
    protected static string $resource = TailorServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
