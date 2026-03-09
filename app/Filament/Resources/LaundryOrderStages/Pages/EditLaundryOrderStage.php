<?php

namespace App\Filament\Resources\LaundryOrderStages\Pages;

use App\Filament\Resources\LaundryOrderStages\LaundryOrderStageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryOrderStage extends EditRecord
{
    protected static string $resource = LaundryOrderStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
