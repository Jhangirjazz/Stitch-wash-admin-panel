<?php

namespace App\Filament\Resources\Addresses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->sortable(),
                TextColumn::make('user.name')->label('User')->searchable(),
                TextColumn::make('label')->searchable(),
                TextColumn::make('address_line1')->label('Address')->limit(30),
                TextColumn::make('city'),
                TextColumn::make('country'),
                TextColumn::make('longitude'),
                TextColumn::make('latitude'),
                IconColumn::make('is_default')->boolean(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                // Add filters if needed (e.g., by city, by user)
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
