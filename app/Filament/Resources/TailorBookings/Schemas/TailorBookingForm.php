<?php

namespace App\Filament\Resources\TailorBookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TailorBookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('booking_number')
                    ->required()
                    ->maxLength(30)
                    ->unique(ignoreRecord: true)
                    ->default(fn () => 'TB-' . strtoupper(uniqid())),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('service_id')
                    ->relationship('service', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('address_id')
                    ->relationship('address', 'address_line1')
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                        $record->label . ': ' . $record->address_line1 . ', ' . $record->area . ', ' . $record->city
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
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
                DatePicker::make('booking_date')
                    ->required(),
                Textarea::make('preferred_time_note')
                    ->nullable(),
                Textarea::make('customer_notes')
                    ->nullable(),
                Select::make('assigned_tailor_id')
                    ->relationship('assignedTailor', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'requested' => 'Requested',
                        'confirmed' => 'Confirmed',
                        'tailor_assigned' => 'Tailor Assigned',
                        'visit_started' => 'Visit Started',
                        'visit_completed' => 'Visit Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('requested')
                    ->required(),
                Textarea::make('completion_notes')
                    ->nullable(),
                TextInput::make('odoo_lead_id')
                    ->maxLength(100)
                    ->nullable(),
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