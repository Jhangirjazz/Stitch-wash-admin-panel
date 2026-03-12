<?php

namespace App\Filament\Resources\LaundryOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LaundryOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('serviceType.name')
                    ->label('Service'),

                TextColumn::make('pickup_slot_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->money('AED')
                    ->sortable(),

                TextColumn::make('current_stage')
                    ->badge(),

                IconColumn::make('is_urgent')
                    ->boolean(),

                TextColumn::make('payment_status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),

                SelectFilter::make('current_stage')
                    ->options([
                        'order_confirmed' => 'Order Confirmed',
                        'pickup_scheduled' => 'Pickup Scheduled',
                        'picked_up' => 'Picked Up',
                        'washing' => 'Washing',
                        'ironing' => 'Ironing',
                        'out_for_delivery' => 'Out for Delivery',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),

                TernaryFilter::make('is_urgent')
                    ->label('Urgent'),

                Filter::make('pickup_slot_date')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($q, $date) => $q->whereDate('pickup_slot_date', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn ($q, $date) => $q->whereDate('pickup_slot_date', '<=', $date)
                            );
                    }),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
