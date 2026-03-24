<?php

namespace App\Filament\Resources\SystemSettings\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;

class SystemSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('setting_key')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                TextColumn::make('setting_value')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('group.name')
                    ->label('Group')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('group_id')
                    ->relationship('group', 'name')
                    ->label('Group'),
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