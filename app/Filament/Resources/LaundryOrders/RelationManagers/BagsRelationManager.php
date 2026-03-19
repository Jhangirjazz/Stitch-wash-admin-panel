<?php

namespace App\Filament\Resources\LaundryOrders\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BagsRelationManager extends RelationManager
{
    protected static string $relationship = 'bags';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bag_number')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('item_count')
                    ->numeric()
                    ->default(0),
                TextInput::make('extra_items')
                    ->numeric()
                    ->default(0),
                TextInput::make('bag_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('extra_charge')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_id')
            ->columns([
                TextColumn::make('bag_number')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('item_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('extra_items')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bag_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('extra_charge')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
