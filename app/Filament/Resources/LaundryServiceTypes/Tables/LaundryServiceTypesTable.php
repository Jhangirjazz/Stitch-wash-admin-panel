<?php

namespace App\Filament\Resources\LaundryServiceTypes\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ColorColumn; // ✅ Import ColorColumn
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class LaundryServiceTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('icon_url')
                    ->label('Icon')
                    ->circular()
                    ->size(40),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('pricing_model')
                    ->badge()
                    ->colors([
                        'success' => 'per_bag',
                        'warning' => 'per_item',
                    ]),
                TextColumn::make('bag_price')
                    ->money('AED')
                    ->toggleable(),
                ColorColumn::make('bag_color')
                    ->label('Bag Color')
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('pricing_model')
                    ->options([
                        'per_item' => 'Per Item',
                        'per_bag' => 'Per Bag',
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