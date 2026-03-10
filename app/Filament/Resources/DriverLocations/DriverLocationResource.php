<?php

namespace App\Filament\Resources\DriverLocations;

use UnitEnum;
use App\Filament\Resources\DriverLocations\Pages\CreateDriverLocation;
use App\Filament\Resources\DriverLocations\Pages\EditDriverLocation;
use App\Filament\Resources\DriverLocations\Pages\ListDriverLocations;
use App\Filament\Resources\DriverLocations\Schemas\DriverLocationForm;
use App\Filament\Resources\DriverLocations\Tables\DriverLocationsTable;
use App\Models\DriverLocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DriverLocationResource extends Resource
{
    protected static ?string $model = DriverLocation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Operations';
    protected static ?int $navigationSort = 2; // adjust per resource


    public static function form(Schema $schema): Schema
    {
        return DriverLocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DriverLocationsTable::configure($table);
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
            'index' => ListDriverLocations::route('/'),
            'create' => CreateDriverLocation::route('/create'),
            'edit' => EditDriverLocation::route('/{record}/edit'),
        ];
    }
}
