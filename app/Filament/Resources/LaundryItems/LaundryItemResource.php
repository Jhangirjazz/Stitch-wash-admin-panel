<?php

namespace App\Filament\Resources\LaundryItems;

use App\Filament\Resources\LaundryItems\Pages\CreateLaundryItem;
use App\Filament\Resources\LaundryItems\Pages\EditLaundryItem;
use App\Filament\Resources\LaundryItems\Pages\ListLaundryItems;
use App\Filament\Resources\LaundryItems\Schemas\LaundryItemForm;
use App\Filament\Resources\LaundryItems\Tables\LaundryItemsTable;
use App\Models\LaundryItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaundryItemResource extends Resource
{
    protected static ?string $model = LaundryItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';

    public static function form(Schema $schema): Schema
    {
        return LaundryItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryItemsTable::configure($table);
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
            'index' => ListLaundryItems::route('/'),
            'create' => CreateLaundryItem::route('/create'),
            'edit' => EditLaundryItem::route('/{record}/edit'),
        ];
    }
}
