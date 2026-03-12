<?php

namespace App\Filament\Resources\TailorMeasurements;

use App\Filament\Resources\TailorMeasurements\Pages\CreateTailorMeasurement;
use App\Filament\Resources\TailorMeasurements\Pages\EditTailorMeasurement;
use App\Filament\Resources\TailorMeasurements\Pages\ListTailorMeasurements;
use App\Filament\Resources\TailorMeasurements\Schemas\TailorMeasurementForm;
use App\Filament\Resources\TailorMeasurements\Tables\TailorMeasurementsTable;
use App\Models\TailorMeasurement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TailorMeasurementResource extends Resource
{
    protected static ?string $model = TailorMeasurement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Tailor Management';

    protected static ?int $navigationSort = 2; // adjust per resource (services first, then bookings, then measurements)

    public static function form(Schema $schema): Schema
    {
        return TailorMeasurementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TailorMeasurementsTable::configure($table);
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
            'index' => ListTailorMeasurements::route('/'),
            'create' => CreateTailorMeasurement::route('/create'),
            'edit' => EditTailorMeasurement::route('/{record}/edit'),
        ];
    }
}
