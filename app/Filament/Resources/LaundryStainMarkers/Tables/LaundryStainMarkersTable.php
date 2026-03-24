<?php

namespace App\Filament\Resources\LaundryStainMarker\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;

class LaundryStainMarkerTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('photo.id')
                    ->label('Photo ID')
                    ->sortable(),
                TextColumn::make('photo.order.order_number')
                    ->label('Order')
                    ->searchable(),
                TextColumn::make('x_percent')
                    ->label('X (%)')
                    ->sortable(),
                TextColumn::make('y_percent')
                    ->label('Y (%)')
                    ->sortable(),
                TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
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