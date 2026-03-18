<?php

namespace App\Filament\Resources\CustomerWallets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerWalletForm
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
                TextInput::make('balance')
                    ->numeric()
                    ->step(0.01)
                    ->required()
                    ->default(0.00),
                TextInput::make('currency')
                    ->default('AED')
                    ->maxLength(3)
                    ->required(),
            ]);
    }
}