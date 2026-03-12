<?php

namespace App\Filament\Resources\LaundryServiceTypes;

use App\Filament\Resources\LaundryServiceTypes\Pages\CreateLaundryServiceType;
use App\Filament\Resources\LaundryServiceTypes\Pages\EditLaundryServiceType;
use App\Filament\Resources\LaundryServiceTypes\Pages\ListLaundryServiceTypes;
use App\Filament\Resources\LaundryServiceTypes\Schemas\LaundryServiceTypeForm;
use App\Filament\Resources\LaundryServiceTypes\Tables\LaundryServiceTypesTable;
use App\Models\LaundryServiceType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaundryServiceTypeResource extends Resource
{
    protected static ?string $model = LaundryServiceType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';

    public static function form(Schema $schema): Schema
    {
        return LaundryServiceTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryServiceTypesTable::configure($table);
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
            'index' => ListLaundryServiceTypes::route('/'),
            'create' => CreateLaundryServiceType::route('/create'),
            'edit' => EditLaundryServiceType::route('/{record}/edit'),
        ];
    }
}
