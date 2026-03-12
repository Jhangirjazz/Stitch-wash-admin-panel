<?php

namespace App\Filament\Resources\LaundryItemCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaundryItemCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_type_id')
                    ->relationship('serviceType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0)
                    ->nullable(),
            ]);
    }
}
