<?php

namespace App\Filament\Resources\LaundryOrders\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('stage_id')
                    ->label('Stage')
                    ->options(function () {
                        $orderId = $this->ownerRecord->id;
                        return \App\Models\LaundryOrderStage::where('order_id', $orderId)
                            ->pluck('stage', 'id');
                    })
                    ->placeholder('Select stage (optional)')
                    ->nullable(),
                Select::make('photo_type')
                    ->options([
                        'before' => 'Before',
                        'after' => 'After',
                        'stain' => 'Stain',
                        'qc' => 'Quality Check',
                        'pickup_proof' => 'Pickup Proof',
                        'delivery_proof' => 'Delivery Proof',
                    ])
                    ->required(),
                // Use TextInput with helper text instead of FileUpload
                TextInput::make('file_url')
                    ->label('Photo URL')
                    ->placeholder('Enter the image URL or path')
                    ->helperText('You can upload images via the media manager and paste the URL here')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('thumbnail_url')
                    ->label('Thumbnail URL (optional)')
                    ->placeholder('Enter thumbnail URL')
                    ->helperText('Optional smaller version of the image')
                    ->nullable()
                    ->columnSpanFull(),
                Select::make('uploaded_by')
                    ->label('Uploaded By')
                    ->options(function () {
                        return \App\Models\User::whereIn('role', ['admin', 'laundry_staff', 'driver'])
                            ->pluck('name', 'id');
                    })
                    ->placeholder('Select staff member')
                    ->nullable(),
                TextInput::make('caption')
                    ->maxLength(255)
                    ->placeholder('Add a caption...')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                // Show image from URL
                ImageColumn::make('file_url')
                    ->label('Photo')
                    ->circular()
                    ->size(50),
                TextColumn::make('photo_type')
                    ->badge(),
                TextColumn::make('stage.stage')
                    ->label('Stage')
                    ->default('No stage'),
                TextColumn::make('uploadedBy.name')
                    ->label('Uploaded By')
                    ->default('Unknown'),
                TextColumn::make('caption')
                    ->limit(30),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('photo_type')
                    ->options([
                        'before' => 'Before',
                        'after' => 'After',
                        'stain' => 'Stain',
                        'qc' => 'Quality Check',
                        'pickup_proof' => 'Pickup Proof',
                        'delivery_proof' => 'Delivery Proof',
                    ]),
            ])
            ->headerActions([
                \Filament\Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}