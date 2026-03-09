<?php

namespace App\Filament\Resources\LaundryOrderPhotos\Pages;

use App\Filament\Resources\LaundryOrderPhotos\LaundryOrderPhotoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaundryOrderPhoto extends EditRecord
{
    protected static string $resource = LaundryOrderPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
