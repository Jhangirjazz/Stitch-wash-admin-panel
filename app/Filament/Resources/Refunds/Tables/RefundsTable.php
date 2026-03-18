<?php

namespace App\Filament\Resources\Refunds\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;

class RefundsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('payment.payment_reference')
                    ->label('Payment')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->money('AED')
                    ->sortable(),
                TextColumn::make('reason')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('gateway_ref')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'processed',
                        'danger' => 'failed',
                    ]),
                TextColumn::make('processedBy.name')
                    ->label('Processed By')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processed' => 'Processed',
                        'failed' => 'Failed',
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