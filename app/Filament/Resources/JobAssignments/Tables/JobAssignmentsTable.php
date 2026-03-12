<?php

namespace App\Filament\Resources\JobAssignments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JobAssignmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('assignment_type')
                    ->badge(),
                TextColumn::make('reference')
                    ->label('Reference #')
                    ->formatStateUsing(fn ($record) => $record->reference?->order_number ?? $record->reference?->booking_number ?? '-'
                    ),
                TextColumn::make('assignedTo.name')
                    ->label('Assigned To'),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('scheduled_at')
                    ->dateTime(),
                ImageColumn::make('proof_photo_url')
                    ->circular()
                    ->size(40),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('assignment_type')
                    ->options([
                        'laundry_pickup' => 'Laundry Pickup',
                        'laundry_delivery' => 'Laundry Delivery',
                        'tailor_visit' => 'Tailor Visit',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'assigned' => 'Assigned',
                        'en_route' => 'En Route',
                        'arrived' => 'Arrived',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ]),
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
