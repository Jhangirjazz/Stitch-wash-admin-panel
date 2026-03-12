<?php

namespace App\Filament\Resources\LaundryOrderItems;

use App\Filament\Resources\LaundryOrderItems\Pages\CreateLaundryOrderItem;
use App\Filament\Resources\LaundryOrderItems\Pages\EditLaundryOrderItem;
use App\Filament\Resources\LaundryOrderItems\Pages\ListLaundryOrderItems;
use App\Filament\Resources\LaundryOrderItems\Schemas\LaundryOrderItemForm;
use App\Filament\Resources\LaundryOrderItems\Tables\LaundryOrderItemsTable;
use App\Models\LaundryOrderItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaundryOrderItemResource extends Resource
{
    protected static ?string $model = LaundryOrderItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';

    public static function form(Schema $schema): Schema
    {
        return LaundryOrderItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryOrderItemsTable::configure($table);
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
            'index' => ListLaundryOrderItems::route('/'),
            'create' => CreateLaundryOrderItem::route('/create'),
            'edit' => EditLaundryOrderItem::route('/{record}/edit'),
        ];
    }
}
