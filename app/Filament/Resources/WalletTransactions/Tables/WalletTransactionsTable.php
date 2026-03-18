<?php

namespace App\Filament\Resources\WalletTransactions\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;

class WalletTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('wallet.user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'success' => 'credit',
                        'danger' => 'debit',
                    ]),
                TextColumn::make('amount')
                    ->money('AED')
                    ->sortable(),
                TextColumn::make('reference')
                    ->label('Reference')
                    ->formatStateUsing(fn ($record) =>
                        $record->reference_type . ' #' . $record->reference_id ?? '-'
                    ),
                TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'credit' => 'Credit',
                        'debit' => 'Debit',
                    ]),
                SelectFilter::make('reference_type')
                    ->options([
                        'order' => 'Order',
                        'payment' => 'Payment',
                        'refund' => 'Refund',
                        'manual' => 'Manual Adjustment',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
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