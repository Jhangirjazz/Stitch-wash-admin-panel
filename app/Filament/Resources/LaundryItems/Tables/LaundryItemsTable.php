<?php

namespace App\Filament\Resources\LaundryItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class LaundryItemsTable
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
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money('AED')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
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
