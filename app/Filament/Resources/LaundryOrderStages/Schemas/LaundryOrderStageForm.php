<?php

namespace App\Filament\Resources\LaundryOrderStages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LaundryOrderStageForm
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
                Select::make('stage')
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
                Select::make('staff_id')
                    ->relationship('staff', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Textarea::make('notes')
                    ->nullable(),
                Toggle::make('is_customer_visible')
                    ->default(true),
            ]);
    }
}