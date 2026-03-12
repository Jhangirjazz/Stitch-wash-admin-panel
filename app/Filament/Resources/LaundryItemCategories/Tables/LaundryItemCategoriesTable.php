<?php

namespace App\Filament\Resources\LaundryItemCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LaundryItemCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('serviceType.name')
                    ->label('Service Type')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('service_type_id')
                    ->relationship('serviceType', 'name')
                    ->label('Service Type'),
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
