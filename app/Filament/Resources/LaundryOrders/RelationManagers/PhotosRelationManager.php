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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('stage_id')
                    ->numeric()
                    ->default(null),
                Select::make('photo_type')
                    ->options([
            'before' => 'Before',
            'after' => 'After',
            'stain' => 'Stain',
            'qc' => 'Qc',
            'pickup_proof' => 'Pickup proof',
            'delivery_proof' => 'Delivery proof',
        ])
                    ->required(),
                TextInput::make('file_url')
                    ->url()
                    ->required(),
                TextInput::make('thumbnail_url')
                    ->url()
                    ->default(null),
                TextInput::make('uploaded_by')
                    ->numeric()
                    ->default(null),
                TextInput::make('caption')
                    ->default(null),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_id')
            ->columns([
                TextColumn::make('stage_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('photo_type')
                    ->badge(),
                TextColumn::make('file_url')
                    ->searchable(),
                TextColumn::make('thumbnail_url')
                    ->searchable(),
                TextColumn::make('uploaded_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('caption')
                    ->searchable(),
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
