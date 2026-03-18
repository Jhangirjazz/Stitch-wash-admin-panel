<?php

namespace App\Filament\Resources\PromoCodes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PromoCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('description')
                    ->default(null),
                Select::make('discount_type')
                    ->options(['percentage' => 'Percentage', 'fixed' => 'Fixed'])
                    ->required(),
                TextInput::make('discount_value')
                    ->required()
                    ->numeric(),
                TextInput::make('min_order_amount')
                    ->numeric()
                    ->default(0.0),
                TextInput::make('max_discount_cap')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_uses_total')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_uses_per_user')
                    ->numeric()
                    ->default(1),
                TextInput::make('used_count')
                    ->numeric()
                    ->default(0),
                DatePicker::make('valid_from')
                    ->required(),
                DatePicker::make('valid_until')
                    ->required(),
                Select::make('applicable_to')
                    ->options(['all' => 'All', 'laundry' => 'Laundry', 'tailor' => 'Tailor'])
                    ->default('all'),
                Toggle::make('is_active'),
            ]);
    }
}
