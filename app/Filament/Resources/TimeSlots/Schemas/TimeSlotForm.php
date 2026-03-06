<?php

namespace App\Filament\Resources\TimeSlots\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TimeSlotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('slot_type')
                    ->options([
                        'pickup' => 'Pickup',
                        'delivery' => 'Delivery',
                        'tailor_visit' => 'Tailor Visit',
                    ])
                    ->required(),
                Select::make('day_of_week')
                    ->options([
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday',
                    ])
                    ->required(),
                TimePicker::make('start_time')
                    ->required(),
                TimePicker::make('end_time')
                    ->required()
                    ->after('start_time'), // optional validation
                TextInput::make('max_bookings')
                    ->numeric()
                    ->integer()
                    ->default(20)
                    ->required(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}