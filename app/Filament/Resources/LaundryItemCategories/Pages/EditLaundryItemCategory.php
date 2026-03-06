<?php

namespace App\Filament\Resources\LaundryItemCategories\Pages;

use App\Filament\Resources\LaundryItemCategories\LaundryItemCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryItemCategory extends EditRecord
{
    protected static string $resource = LaundryItemCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
