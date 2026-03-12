<?php

namespace App\Filament\Resources\Fabrics\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FabricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(150),
                TextInput::make('fabric_code')
                    ->maxLength(50)
                    ->unique(ignoreRecord: true)
                    ->nullable(),
                TextInput::make('material_type')
                    ->maxLength(100)
                    ->nullable(),
                TextInput::make('color')
                    ->maxLength(100)
                    ->nullable(),
                TextInput::make('pattern')
                    ->maxLength(100)
                    ->nullable(),
                TextInput::make('price_per_meter')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('price_per_piece')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),
                TextInput::make('currency')
                    ->default('AED')
                    ->maxLength(3)
                    ->required(),
                Select::make('stock_status')
                    ->options([
                        'available' => 'Available',
                        'out_of_stock' => 'Out of Stock',
                        'coming_soon' => 'Coming Soon',
                    ])
                    ->default('available')
                    ->required(),
                Textarea::make('care_instructions')
                    ->nullable(),
                Textarea::make('description')
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('odoo_product_id')
                    ->maxLength(100)
                    ->nullable(),
            ]);
    }
}
