<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('payment_reference')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('order_type')
                    ->badge(),
                TextColumn::make('order')
                    ->label('Order')
                    ->formatStateUsing(fn ($record) =>
                        $record->order?->order_number ?? $record->order?->booking_number ?? '-'
                    ),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->money('AED')
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->badge(),
                TextColumn::make('gateway')
                    ->badge(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'success' => 'paid',
                        'danger' => 'failed',
                        'secondary' => 'refunded',
                    ]),
                TextColumn::make('paid_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
                SelectFilter::make('payment_method')
                    ->options([
                        'card' => 'Card',
                        'apple_pay' => 'Apple Pay',
                        'google_pay' => 'Google Pay',
                        'cash' => 'Cash',
                        'wallet' => 'Wallet',
                    ]),
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