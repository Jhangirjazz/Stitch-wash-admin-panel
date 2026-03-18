<?php

namespace App\Filament\Resources\Refunds\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RefundForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('payment_id')
                    ->relationship('payment', 'payment_reference')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('amount')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                TextInput::make('reason')
                    ->nullable(),
                TextInput::make('gateway_ref')
                    ->maxLength(255)
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processed' => 'Processed',
                        'failed' => 'Failed',
                    ])
                    ->default('pending')
                    ->required(),
                Select::make('processed_by')
                    ->relationship('processedBy', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
            ]);
    }
}