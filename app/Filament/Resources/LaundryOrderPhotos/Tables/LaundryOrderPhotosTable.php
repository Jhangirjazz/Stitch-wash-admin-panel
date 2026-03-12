<?php

namespace App\Filament\Resources\LaundryOrderPhotos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaundryOrderPhotosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.order_number')
                    ->label('Order #')
                    ->searchable(),
                ImageColumn::make('file_url')
                    ->circular()
                    ->size(40),
                TextColumn::make('photo_type'),
                TextColumn::make('caption')->limit(30),
                TextColumn::make('uploadedBy.name'),
                TextColumn::make('created_at')
                    ->dateTime(),
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
