<?php

namespace App\Filament\Resources\SlotAvailabilities\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SlotAvailabilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('time_slot_id')
                    ->relationship('timeSlot', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->slot_type . ' - ' .
                        ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][$record->day_of_week] . ' ' .
                        $record->start_time . '-' . $record->end_time
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('slot_date')
                    ->required(),
                TextInput::make('booked_count')
                    ->numeric()
                    ->integer()
                    ->default(0)
                    ->helperText('Automatically updated when orders are placed.'),
                Toggle::make('is_blocked')
                    ->label('Blocked')
                    ->helperText('Manually block this slot for the selected date.'),
            ]);
    }
}