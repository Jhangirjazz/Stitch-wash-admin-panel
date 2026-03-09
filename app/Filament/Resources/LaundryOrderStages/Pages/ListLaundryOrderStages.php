<?php

namespace App\Filament\Resources\LaundryOrderStages\Pages;

use App\Filament\Resources\LaundryOrderStages\LaundryOrderStageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryOrderStages extends ListRecords
{
    protected static string $resource = LaundryOrderStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
