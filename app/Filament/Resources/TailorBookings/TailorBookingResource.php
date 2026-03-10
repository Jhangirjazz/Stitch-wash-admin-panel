<?php

namespace App\Filament\Resources\TailorBookings;

use UnitEnum;
use App\Filament\Resources\TailorBookings\Pages\CreateTailorBooking;
use App\Filament\Resources\TailorBookings\Pages\EditTailorBooking;
use App\Filament\Resources\TailorBookings\Pages\ListTailorBookings;
use App\Filament\Resources\TailorBookings\Schemas\TailorBookingForm;
use App\Filament\Resources\TailorBookings\Tables\TailorBookingsTable;
use App\Models\TailorBooking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TailorBookingResource extends Resource
{
    protected static ?string $model = TailorBooking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Tailor Management';
    protected static ?int $navigationSort = 1; // adjust per resource (services first, then bookings, then measurements)

    public static function form(Schema $schema): Schema
    {
        return TailorBookingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TailorBookingsTable::configure($table);
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
            'index' => ListTailorBookings::route('/'),
            'create' => CreateTailorBooking::route('/create'),
            'edit' => EditTailorBooking::route('/{record}/edit'),
        ];
    }
}
