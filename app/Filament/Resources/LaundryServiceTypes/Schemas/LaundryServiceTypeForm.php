<?php

namespace App\Filament\Resources\LaundryServiceTypes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LaundryServiceTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->helperText('URL-friendly version of the name (e.g., "clean-and-press"). Will be auto-generated if left blank.'),
                Textarea::make('description')
                    ->nullable()
                    ->maxLength(65535),
                FileUpload::make('icon_url')
                    ->label('Icon')
                    ->image()
                    ->directory('service-icons')
                    ->visibility('public')
                    ->nullable(),
                // TextInput::make('bag_color')
                //     ->maxLength(20)
                //     ->nullable()
                //     ->helperText('Optional color code (e.g., red, #FF0000) for bag identification.'),
                ColorPicker::make('bag_color')
                    ->nullable()
                    ->helperText('Select a color for bag identification.'),
                Select::make('pricing_model')
                    ->options([
                        'per_item' => 'Per Item',
                        'per_bag' => 'Per Bag',
                    ])
                    ->required()
                    ->default('per_item'),
                TextInput::make('bag_price')
                    ->numeric()
                    ->step(0.01)
                    ->nullable()
                    ->visible(fn ($get) => $get('pricing_model') === 'per_bag')
                    ->requiredWith('pricing_model', 'per_bag'),
                TextInput::make('bag_capacity_kg')
                    ->numeric()
                    ->step(0.01)
                    ->nullable()
                    ->visible(fn ($get) => $get('pricing_model') === 'per_bag'),
                TextInput::make('bag_max_items')
                    ->numeric()
                    ->integer()
                    ->nullable()
                    ->visible(fn ($get) => $get('pricing_model') === 'per_bag'),
                TextInput::make('extra_item_price')
                    ->numeric()
                    ->step(0.01)
                    ->nullable()
                    ->visible(fn ($get) => $get('pricing_model') === 'per_bag'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0)
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}