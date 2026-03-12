<?php

namespace App\Filament\Resources\Addresses\Schemas;

use App\Filament\Forms\Components\LocationPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AddressForm
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
                TextInput::make('label')
                    ->maxLength(50)
                    ->nullable(),
                TextInput::make('address_line1')
                    ->required()
                    ->maxLength(250),
                TextInput::make('address_line2')
                    ->maxLength(250)
                    ->nullable(),
                TextInput::make('area')
                    ->maxLength(100)
                    ->nullable(),
                TextInput::make('city')
                    ->default('Dubai')
                    ->maxLength(100)
                    ->required(),
                TextInput::make('emirate')
                    ->maxLength(100)
                    ->nullable(),
                TextInput::make('country')
                    ->default('UAE')
                    ->maxLength(3)
                    ->required(),
                TextInput::make('latitude')
                    ->numeric()
                    ->nullable()
                    ->rules(['nullable', 'numeric', 'between:-90,90'])
                    ->validationMessages([
                        'between' => 'Latitude must be between -90 and 90 degrees.',
                    ]),
                TextInput::make('longitude')
                    ->numeric()
                    ->nullable()
                    ->rules(['nullable', 'numeric', 'between:-180,180'])
                    ->validationMessages([
                        'between' => 'Longitude must be between -180 and 180 degrees.',
                    ]),
                LocationPicker::make('location_picker')
                    ->label('Pick location on map')
                    ->afterStateHydrated(function ($component, $state, $set) {
                        $set('latitude', $state['lat'] ?? 25.2048);
                        $set('longitude', $state['lng'] ?? 55.2708);
                    })
                    ->afterStateUpdated(function ($state, $set) {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                        $set('address_line1', $state['address_line1'] ?? '');
                        $set('city', $state['city'] ?? '');
                        $set('area', $state['area'] ?? '');
                        $set('country', ($state['country'] ?? 'AE'));
                    })
                    ->columnSpanFull(),
                Toggle::make('is_default')
                    ->default(false),
            ]);
    }
}
