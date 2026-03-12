<?php

namespace App\Filament\Resources\TailorMeasurements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TailorMeasurementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('booking.booking_number')
                    ->label('Booking #')
                    ->searchable(),
                TextColumn::make('chest'),
                TextColumn::make('shoulder'),
                TextColumn::make('waist'),
                TextColumn::make('hip'),
                TextColumn::make('sleeve_length'),
                TextColumn::make('trouser_lenght'),
                TextColumn::make('neck'),
                TextColumn::make('unit'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
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
