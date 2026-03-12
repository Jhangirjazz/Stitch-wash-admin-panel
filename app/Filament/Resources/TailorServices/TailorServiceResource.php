<?php

namespace App\Filament\Resources\TailorServices;

use App\Filament\Resources\TailorServices\Pages\CreateTailorService;
use App\Filament\Resources\TailorServices\Pages\EditTailorService;
use App\Filament\Resources\TailorServices\Pages\ListTailorServices;
use App\Filament\Resources\TailorServices\Schemas\TailorServiceForm;
use App\Filament\Resources\TailorServices\Tables\TailorServicesTable;
use App\Models\TailorService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TailorServiceResource extends Resource
{
    protected static ?string $model = TailorService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Tailor Management';

    protected static ?int $navigationSort = 3; // adjust per resource (services first, then bookings, then measurements)

    public static function form(Schema $schema): Schema
    {
        return TailorServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TailorServicesTable::configure($table);
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
            'index' => ListTailorServices::route('/'),
            'create' => CreateTailorService::route('/create'),
            'edit' => EditTailorService::route('/{record}/edit'),
        ];
    }
}
