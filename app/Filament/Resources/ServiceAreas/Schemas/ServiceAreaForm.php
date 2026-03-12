<?php

namespace App\Filament\Resources\ServiceAreas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceAreaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('city')
                    ->default('Dubai')
                    ->maxLength(100)
                    ->required(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
