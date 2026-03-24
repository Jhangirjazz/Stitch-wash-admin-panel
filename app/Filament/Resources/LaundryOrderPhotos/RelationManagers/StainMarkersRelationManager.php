<?php

namespace App\Filament\Resources\LaundryOrderPhotos\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StainMarkersRelationManager extends RelationManager
{
    protected static string $relationship = 'stainMarkers';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema  // Changed from Form to Schema
    {
        return $schema
            ->components([
                TextInput::make('x_percent')
                    ->label('X Position (%)')
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                TextInput::make('y_percent')
                    ->label('Y Position (%)')
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                TextInput::make('description')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('x_percent')
                    ->label('X (%)'),
                TextColumn::make('y_percent')
                    ->label('Y (%)'),
                TextColumn::make('description')
                    ->limit(30),
            ])
            ->headerActions([
                \Filament\Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),
            ]);
    }
}