<?php

namespace App\Filament\Resources\TimeSlots\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TimeSlotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('slot_type')->badge(),
                TextColumn::make('day_of_week')
                    ->formatStateUsing(fn ($state) => [
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday',
                    ][$state] ?? $state),
                TextColumn::make('start_time')->time('H:i'),
                TextColumn::make('end_time')->time('H:i'),
                TextColumn::make('max_bookings'),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->dateTime()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('slot_type')
                    ->options([
                        'pickup' => 'Pickup',
                        'delivery' => 'Delivery',
                        'tailor_visit' => 'Tailor Visit',
                    ]),
                SelectFilter::make('day_of_week')
                    ->options([
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday',
                    ]),
                TernaryFilter::make('is_active'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
