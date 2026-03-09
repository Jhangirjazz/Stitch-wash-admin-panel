<?php

namespace App\Filament\Resources\LaundryOrderPhotos\Pages;

use App\Filament\Resources\LaundryOrderPhotos\LaundryOrderPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaundryOrderPhotos extends ListRecords
{
    protected static string $resource = LaundryOrderPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
