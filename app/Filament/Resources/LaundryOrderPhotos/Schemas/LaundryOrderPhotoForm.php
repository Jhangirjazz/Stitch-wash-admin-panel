<?php

namespace App\Filament\Resources\LaundryOrderPhotos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaundryOrderPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->relationship('order', 'order_number')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('photo_type')
                    ->options([
                        'before' => 'Before',
                        'after' => 'After',
                        'stain' => 'Stain',
                        'qc' => 'QC',
                        'pickup_proof' => 'Pickup Proof',
                        'delivery_proof' => 'Delivery Proof',
                    ])
                    ->required(),
                FileUpload::make('file_url')
                    ->image()
                    ->directory('order-photos')
                    ->visibility('public')
                    ->required(),
                FileUpload::make('thumbnail_url')
                    ->image()
                    ->directory('order-photos/thumbnails')
                    ->visibility('public')
                    ->nullable(),
                Select::make('uploaded_by')
                    ->relationship('uploadedBy', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('caption')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }
}