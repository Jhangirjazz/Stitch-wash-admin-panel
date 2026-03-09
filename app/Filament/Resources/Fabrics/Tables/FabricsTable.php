<?php

namespace App\Filament\Resources\Fabrics\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class FabricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fabric_code')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('material_type'),
                TextColumn::make('color'),
                TextColumn::make('price_per_meter')
                    ->money('AED')
                    ->toggleable(),
                TextColumn::make('price_per_piece')
                    ->money('AED')
                    ->toggleable(),
                TextColumn::make('stock_status')
                    ->badge()
                    ->colors([
                        'success' => 'available',
                        'danger' => 'out_of_stock',
                        'warning' => 'coming_soon',
                    ]),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('stock_status')
                    ->options([
                        'available' => 'Available',
                        'out_of_stock' => 'Out of Stock',
                        'coming_soon' => 'Coming Soon',
                    ]),
                TernaryFilter::make('is_active'),
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