<?php

namespace App\Filament\Resources\LaundryOrderItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaundryOrderItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->relationship('order', 'order_number')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('laundry_item_id')
                    ->relationship('laundryItem', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('quantity')
                    ->numeric()
                    ->integer()
                    ->default(1)
                    ->required(),
                TextInput::make('unit_price')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                TextInput::make('total_price')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                TextInput::make('notes')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }
}
