<?php

namespace App\Filament\Resources\SettingGroups\Pages;

use App\Filament\Resources\SettingGroups\SettingGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSettingGroups extends ListRecords
{
    protected static string $resource = SettingGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
