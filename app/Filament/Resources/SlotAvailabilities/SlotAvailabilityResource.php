<?php

namespace App\Filament\Resources\SlotAvailabilities;

use App\Filament\Resources\SlotAvailabilities\Pages\CreateSlotAvailability;
use App\Filament\Resources\SlotAvailabilities\Pages\EditSlotAvailability;
use App\Filament\Resources\SlotAvailabilities\Pages\ListSlotAvailabilities;
use App\Filament\Resources\SlotAvailabilities\Schemas\SlotAvailabilityForm;
use App\Filament\Resources\SlotAvailabilities\Tables\SlotAvailabilitiesTable;
use App\Models\SlotAvailability;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SlotAvailabilityResource extends Resource
{
    protected static ?string $model = SlotAvailability::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Scheduling';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return SlotAvailabilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SlotAvailabilitiesTable::configure($table);
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
            'index' => ListSlotAvailabilities::route('/'),
            'create' => CreateSlotAvailability::route('/create'),
            'edit' => EditSlotAvailability::route('/{record}/edit'),
        ];
    }
}
