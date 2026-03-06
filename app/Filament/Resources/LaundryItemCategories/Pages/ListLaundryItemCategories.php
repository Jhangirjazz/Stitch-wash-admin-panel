<?php

namespace App\Filament\Resources\LaundryItemCategories\Pages;

use App\Filament\Resources\LaundryItemCategories\LaundryItemCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryItemCategories extends ListRecords
{
    protected static string $resource = LaundryItemCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
