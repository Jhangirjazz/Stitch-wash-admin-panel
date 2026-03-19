<?php

namespace App\Filament\Resources\LaundryOrderPhotos;

use App\Filament\Resources\LaundryOrderPhotos\Pages\CreateLaundryOrderPhoto;
use App\Filament\Resources\LaundryOrderPhotos\Pages\EditLaundryOrderPhoto;
use App\Filament\Resources\LaundryOrderPhotos\Pages\ListLaundryOrderPhotos;
use App\Filament\Resources\LaundryOrderPhotos\Schemas\LaundryOrderPhotoForm;
use App\Filament\Resources\LaundryOrderPhotos\Tables\LaundryOrderPhotosTable;
use App\Models\LaundryOrderPhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaundryOrderPhotoResource extends Resource
{
    protected static ?string $model = LaundryOrderPhoto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';

    protected static ?int $navigationSort = 7; // adjust order as needed

    public static function form(Schema $schema): Schema
    {
        return LaundryOrderPhotoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryOrderPhotosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
        \App\Filament\Resources\LaundryOrderPhoto\RelationManagers\StainMarkersRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaundryOrderPhotos::route('/'),
            'create' => CreateLaundryOrderPhoto::route('/create'),
            'edit' => EditLaundryOrderPhoto::route('/{record}/edit'),
        ];
    }
}
