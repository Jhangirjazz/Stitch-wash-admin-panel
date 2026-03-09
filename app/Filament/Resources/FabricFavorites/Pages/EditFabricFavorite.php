<?php

namespace App\Filament\Resources\FabricFavorites\Pages;

use App\Filament\Resources\FabricFavorites\FabricFavoriteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFabricFavorite extends EditRecord
{
    protected static string $resource = FabricFavoriteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
