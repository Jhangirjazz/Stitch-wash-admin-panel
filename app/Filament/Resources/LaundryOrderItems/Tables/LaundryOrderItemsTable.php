<?php

namespace App\Filament\Resources\LaundryOrderItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaundryOrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('laundryItem.name')
                    ->label('Item')
                    ->searchable(),
                TextColumn::make('quantity'),
                TextColumn::make('unit_price')
                    ->money('AED'),
                TextColumn::make('total_price')
                    ->money('AED'),
                TextColumn::make('notes')
                    ->limit(50),
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
