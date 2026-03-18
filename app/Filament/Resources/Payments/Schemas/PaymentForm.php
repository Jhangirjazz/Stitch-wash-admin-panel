<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('payment_reference')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->default(fn () => 'PAY-' . strtoupper(uniqid())),
                Select::make('order_type')
                    ->options([
                        'laundry' => 'Laundry',
                        'tailor' => 'Tailor',
                    ])
                    ->required()
                    ->live(),
                Select::make('order_id')
                    ->label('Order')
                    ->options(function ($get) {
                        $type = $get('order_type');
                        if ($type === 'laundry') {
                            return \App\Models\LaundryOrder::query()->pluck('order_number', 'id');
                        } elseif ($type === 'tailor') {
                            return \App\Models\TailorBooking::query()->pluck('booking_number', 'id');
                        }
                        return [];
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('amount')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                TextInput::make('currency')
                    ->default('AED')
                    ->maxLength(3)
                    ->required(),
                Select::make('payment_method')
                    ->options([
                        'card' => 'Card',
                        'apple_pay' => 'Apple Pay',
                        'google_pay' => 'Google Pay',
                        'cash' => 'Cash',
                        'wallet' => 'Wallet',
                    ])
                    ->required(),
                Select::make('gateway')
                    ->options([
                        'stripe' => 'Stripe',
                        'telr' => 'Telr',
                        'paytabs' => 'Paytabs',
                        'network_international' => 'Network International',
                        'manual' => 'Manual',
                    ])
                    ->nullable(),
                TextInput::make('gateway_ref')
                    ->maxLength(255)
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('gateway_response')
                    ->nullable()
                    ->columnSpanFull(),
                DateTimePicker::make('paid_at')
                    ->nullable(),
            ]);
    }
}