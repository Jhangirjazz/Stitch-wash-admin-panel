<?php

namespace App\Filament\Resources\FabricImages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FabricImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('fabric_id')
                    ->relationship('fabric', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                FileUpload::make('image_url')
                    ->image()
                    ->directory('fabrics')
                    ->visibility('public')
                    ->required(),
                Toggle::make('is_primary')
                    ->label('Primary Image')
                    ->default(false),
                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0),
            ]);
    }
}
