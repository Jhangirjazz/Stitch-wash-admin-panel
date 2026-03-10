<?php

namespace App\Filament\Resources\JobAssignments\Pages;

use App\Filament\Resources\JobAssignments\JobAssignmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJobAssignment extends EditRecord
{
    protected static string $resource = JobAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
