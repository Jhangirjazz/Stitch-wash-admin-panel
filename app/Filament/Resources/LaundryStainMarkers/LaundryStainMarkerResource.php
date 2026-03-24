<?php

namespace App\Filament\Resources\LaundryStainMarkers;

use UnitEnum;
use App\Filament\Resources\LaundryStainMarkers\Pages\CreateLaundryStainMarker;
use App\Filament\Resources\LaundryStainMarkers\Pages\EditLaundryStainMarker;
use App\Filament\Resources\LaundryStainMarkers\Pages\ListLaundryStainMarkers;
use App\Filament\Resources\LaundryStainMarkers\Schemas\LaundryStainMarkerForm;
use App\Filament\Resources\LaundryStainMarkers\Tables\LaundryStainMarkersTable;
use App\Models\LaundryStainMarker;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaundryStainMarkerResource extends Resource
{
    protected static ?string $model = LaundryStainMarker::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationCircle;
    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';
    protected static ?int $navigationSort = 6; // after photos


    public static function form(Schema $schema): Schema
    {
        return LaundryStainMarkerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryStainMarkersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaundryStainMarkers::route('/'),
            'create' => CreateLaundryStainMarker::route('/create'),
            'edit' => EditLaundryStainMarker::route('/{record}/edit'),
        ];
    }
}
