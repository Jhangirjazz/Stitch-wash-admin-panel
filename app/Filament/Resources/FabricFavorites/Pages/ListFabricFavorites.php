<?php

namespace App\Filament\Resources\FabricFavorites\Pages;

use App\Filament\Resources\FabricFavorites\FabricFavoriteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFabricFavorites extends ListRecords
{
    protected static string $resource = FabricFavoriteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
