<?php

namespace App\Filament\Resources\LaundryOrders;

use UnitEnum;
use App\Filament\Resources\LaundryOrders\Pages\CreateLaundryOrder;
use App\Filament\Resources\LaundryOrders\Pages\EditLaundryOrder;
use App\Filament\Resources\LaundryOrders\Pages\ListLaundryOrders;
use App\Filament\Resources\LaundryOrders\Schemas\LaundryOrderForm;
use App\Filament\Resources\LaundryOrders\Tables\LaundryOrdersTable;
use App\Models\LaundryOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaundryOrderResource extends Resource
{
    protected static ?string $model = LaundryOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';
    protected static ?int $navigationSort = 4; // assuming service types=1, categories=2, items=3

    public static function form(Schema $schema): Schema
    {
        return LaundryOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryOrdersTable::configure($table);
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
            'index' => ListLaundryOrders::route('/'),
            'create' => CreateLaundryOrder::route('/create'),
            'edit' => EditLaundryOrder::route('/{record}/edit'),
        ];
    }
}
