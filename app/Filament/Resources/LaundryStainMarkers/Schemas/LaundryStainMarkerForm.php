<?php

namespace App\Filament\Resources\LaundryStainMarker\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaundryStainMarkerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('photo_id')
                    ->relationship('photo', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => 
                        'Photo #' . $record->id . ' - ' . ($record->photo_type ?? 'Unknown')
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('x_percent')
                    ->label('X Position (%)')
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                TextInput::make('y_percent')
                    ->label('Y Position (%)')
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                Textarea::make('description')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }
}