<?php

namespace App\Filament\Resources\FabricFavorites\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class FabricFavoriteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('fabric_id')
                    ->relationship('fabric', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
