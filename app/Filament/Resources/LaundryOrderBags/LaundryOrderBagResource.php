<?php

namespace App\Filament\Resources\LaundryOrderBags;

use App\Filament\Resources\LaundryOrderBags\Pages\CreateLaundryOrderBag;
use App\Filament\Resources\LaundryOrderBags\Pages\EditLaundryOrderBag;
use App\Filament\Resources\LaundryOrderBags\Pages\ListLaundryOrderBags;
use App\Filament\Resources\LaundryOrderBags\Schemas\LaundryOrderBagForm;
use App\Filament\Resources\LaundryOrderBags\Tables\LaundryOrderBagsTable;
use App\Models\LaundryOrderBag;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaundryOrderBagResource extends Resource
{
    protected static ?string $model = LaundryOrderBag::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';

    protected static ?int $navigationSort = 5; // adjust order as needed

    public static function form(Schema $schema): Schema
    {
        return LaundryOrderBagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryOrderBagsTable::configure($table);
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
            'index' => ListLaundryOrderBags::route('/'),
            'create' => CreateLaundryOrderBag::route('/create'),
            'edit' => EditLaundryOrderBag::route('/{record}/edit'),
        ];
    }
}
