<?php

namespace App\Filament\Resources\DriverLocations\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class DriverLocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('driver.name')
                    ->label('Driver')
                    ->searchable(),
                TextColumn::make('latitude'),
                TextColumn::make('longitude'),
                TextColumn::make('speed_kmh')->label('Speed (km/h)'),
                TextColumn::make('recorded_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('recorded_at', 'desc')
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