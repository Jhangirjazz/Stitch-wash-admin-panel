<?php

namespace App\Filament\Resources\JobAssignments\Pages;

use App\Filament\Resources\JobAssignments\JobAssignmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobAssignments extends ListRecords
{
    protected static string $resource = JobAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
