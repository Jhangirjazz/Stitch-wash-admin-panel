<?php

namespace App\Filament\Resources\SlotAvailabilities\Tables;

use Filament\Tables\Table;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class SlotAvailabilitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('timeSlot.slot_type')->badge(),
                TextColumn::make('timeSlot.day_of_week')
                    ->formatStateUsing(fn ($record) =>
                        ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][$record->timeSlot->day_of_week] ?? ''
                    ),
                TextColumn::make('timeSlot.start_time')->time('H:i'),
                TextColumn::make('timeSlot.end_time')->time('H:i'),
                TextColumn::make('slot_date')->date(),
                TextColumn::make('booked_count'),
                IconColumn::make('is_blocked')->boolean(),
                TextColumn::make('created_at')->dateTime()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('time_slot_id')
                    ->relationship('timeSlot', 'id')
                    ->label('Time Slot'),
                Filter::make('slot_date')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('slot_date', '>=', $date))
                            ->when($data['until'], fn ($q, $date) => $q->whereDate('slot_date', '<=', $date));
                    }),
                TernaryFilter::make('is_blocked'),
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