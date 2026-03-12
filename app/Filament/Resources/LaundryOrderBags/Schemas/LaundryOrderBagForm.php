<?php

namespace App\Filament\Resources\LaundryOrderBags\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaundryOrderBagForm
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
                TextInput::make('bag_number')
                    ->numeric()
                    ->integer()
                    ->default(1)
                    ->required(),
                TextInput::make('item_count')
                    ->numeric()
                    ->integer()
                    ->default(0),
                TextInput::make('extra_items')
                    ->numeric()
                    ->integer()
                    ->default(0),
                TextInput::make('bag_price')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                TextInput::make('extra_charge')
                    ->numeric()
                    ->step(0.01)
                    ->default(0),
            ]);
    }
}
