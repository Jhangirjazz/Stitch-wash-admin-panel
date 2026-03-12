<?php

namespace App\Filament\Resources\LaundryItemCategories;

use App\Filament\Resources\LaundryItemCategories\Pages\CreateLaundryItemCategory;
use App\Filament\Resources\LaundryItemCategories\Pages\EditLaundryItemCategory;
use App\Filament\Resources\LaundryItemCategories\Pages\ListLaundryItemCategories;
use App\Filament\Resources\LaundryItemCategories\Schemas\LaundryItemCategoryForm;
use App\Filament\Resources\LaundryItemCategories\Tables\LaundryItemCategoriesTable;
use App\Models\LaundryItemCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaundryItemCategoryResource extends Resource
{
    protected static ?string $model = LaundryItemCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';

    public static function form(Schema $schema): Schema
    {
        return LaundryItemCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryItemCategoriesTable::configure($table);
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
            'index' => ListLaundryItemCategories::route('/'),
            'create' => CreateLaundryItemCategory::route('/create'),
            'edit' => EditLaundryItemCategory::route('/{record}/edit'),
        ];
    }
}
