<?php

namespace App\Filament\Resources\DriverLocations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DriverLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('driver_id')
                    ->relationship('driver', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('latitude')
                    ->numeric()
                    ->step(0.00000001)
                    ->required(),
                TextInput::make('longitude')
                    ->numeric()
                    ->step(0.00000001)
                    ->required(),
                TextInput::make('speed_kmh')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('heading')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                DateTimePicker::make('recorded_at')
                    ->required(),
            ]);
    }
}