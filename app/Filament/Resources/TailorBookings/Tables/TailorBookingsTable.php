<?php

namespace App\Filament\Resources\TailorBookings\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class TailorBookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('service.name')
                    ->label('Service'),
                TextColumn::make('booking_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('timeSlot')
                    ->formatStateUsing(fn ($record) =>
                        $record->timeSlot?->start_time . '-' . $record->timeSlot?->end_time
                    ),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('assignedTailor.name')
                    ->label('Tailor'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'requested' => 'Requested',
                        'confirmed' => 'Confirmed',
                        'tailor_assigned' => 'Tailor Assigned',
                        'visit_started' => 'Visit Started',
                        'visit_completed' => 'Visit Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                Filter::make('booking_date')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('booking_date', '>=', $date))
                            ->when($data['until'], fn ($q, $date) => $q->whereDate('booking_date', '<=', $date));
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}