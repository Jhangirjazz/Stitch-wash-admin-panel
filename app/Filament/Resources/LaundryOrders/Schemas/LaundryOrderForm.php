<?php

namespace App\Filament\Resources\LaundryOrders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class LaundryOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                // Order number – usually auto-generated, but can be made read-only
                TextInput::make('order_number')
                    ->required()
                    ->maxLength(30)
                    ->unique(ignoreRecord: true)
                    ->default(fn () => 'ORD-' . strtoupper(uniqid())),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('service_type_id')
                    ->relationship('serviceType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('pickup_type')
                    ->options([
                        'pickup' => 'Pickup',
                        'dropoff' => 'Dropoff',
                    ])
                    ->default('pickup')
                    ->required(),
                // Addresses
                Select::make('pickup_address_id')
                    ->relationship('pickupAddress', 'address_line1')
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->label . ': ' . $record->address_line1 . ', ' . $record->area . ', ' . $record->city
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Select::make('delivery_address_id')
                    ->relationship('deliveryAddress', 'address_line1')
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->label . ': ' . $record->address_line1 . ', ' . $record->area . ', ' . $record->city
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),
                // Pickup slot
                Select::make('pickup_slot_id')
                    ->relationship('pickupSlot', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->slot_type . ' - ' .
                        ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][$record->day_of_week] . ' ' .
                        $record->start_time . '-' . $record->end_time
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('pickup_slot_date')
                    ->required(),
                // Delivery slot (optional)
                Select::make('delivery_slot_id')
                    ->relationship('deliverySlot', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->slot_type . ' - ' .
                        ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][$record->day_of_week] . ' ' .
                        $record->start_time . '-' . $record->end_time
                    )
                    ->searchable()
                    ->preload()
                    ->nullable(),
                DatePicker::make('delivery_slot_date')
                    ->nullable(),
                // Promo code (optional)
                Select::make('promo_code_id')
                    ->relationship('promoCode', 'code')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                // Pricing fields – maybe read-only, calculated automatically
                Grid::make(2)
                    ->schema([
                        TextInput::make('subtotal')
                            ->numeric()
                            ->step(0.01)
                            ->required(),
                        TextInput::make('discount_amount')
                            ->numeric()
                            ->step(0.01)
                            ->default(0),
                        TextInput::make('vat_amount')
                            ->numeric()
                            ->step(0.01)
                            ->required(),
                        TextInput::make('delivery_fee')
                            ->numeric()
                            ->step(0.01)
                            ->default(0),
                    ]),
                TextInput::make('total_amount')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('customer_notes')
                    ->nullable(),
                Toggle::make('is_urgent')
                    ->label('Urgent')
                    ->default(false),
                Select::make('current_stage')
                    ->options([
                        'order_confirmed' => 'Order Confirmed',
                        'pickup_scheduled' => 'Pickup Scheduled',
                        'picked_up' => 'Picked Up',
                        'at_facility' => 'At Facility',
                        'inspection' => 'Inspection',
                        'washing' => 'Washing',
                        'drying' => 'Drying',
                        'ironing' => 'Ironing',
                        'quality_check' => 'Quality Check',
                        'packaging' => 'Packaging',
                        'out_for_delivery' => 'Out for Delivery',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                TextInput::make('odoo_order_id')
                    ->nullable()
                    ->maxLength(100),
                // Display created_at/updated_at on edit only
                Placeholder::make('created_at')
                    ->label('Created')
                    ->content(fn ($record) => $record?->created_at?->format('Y-m-d H:i:s'))
                    ->visibleOn('edit'),
                Placeholder::make('updated_at')
                    ->label('Last Updated')
                    ->content(fn ($record) => $record?->updated_at?->format('Y-m-d H:i:s'))
                    ->visibleOn('edit'),
            ]);
    }
}