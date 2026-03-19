<?php

namespace App\Filament\Resources\LaundryStainMarkers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaundryStainMarkerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('photo_id')
                    ->required()
                    ->numeric(),
                TextInput::make('x_percent')
                    ->required()
                    ->numeric(),
                TextInput::make('y_percent')
                    ->required()
                    ->numeric(),
                TextInput::make('description')
                    ->default(null),
            ]);
    }
}
