<?php

namespace App\Filament\Resources\LaundryItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LaundryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(150),
                TextInput::make('price')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                TextInput::make('currency')
                    ->default('AED')
                    ->maxLength(3)
                    ->required(),
                FileUpload::make('icon_url')
                    ->label('Icon')
                    ->image()
                    ->directory('item-icons')
                    ->visibility('public')
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0)
                    ->nullable(),
            ]);
    }
}
