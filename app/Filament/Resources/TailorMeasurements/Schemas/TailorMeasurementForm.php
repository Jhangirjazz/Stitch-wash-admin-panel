<?php

namespace App\Filament\Resources\TailorMeasurements\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TailorMeasurementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('booking_id')
                    ->relationship('booking', 'booking_number')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('chest')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('shoulder')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('waist')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('hip')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('sleeve_length')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('trouser_length')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('neck')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                Textarea::make('extra_notes')
                    ->nullable(),
                Select::make('unit')
                    ->options([
                        'cm' => 'Centimeters',
                        'inch' => 'Inches',
                    ])
                    ->default('cm')
                    ->required(),
            ]);
    }
}