<?php

namespace App\Filament\Resources\SettingGroups\Pages;

use App\Filament\Resources\SettingGroups\SettingGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSettingGroup extends EditRecord
{
    protected static string $resource = SettingGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
