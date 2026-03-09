<?php

namespace App\Filament\Resources\FabricImages;

use UnitEnum;
use App\Filament\Resources\FabricImages\Pages\CreateFabricImage;
use App\Filament\Resources\FabricImages\Pages\EditFabricImage;
use App\Filament\Resources\FabricImages\Pages\ListFabricImages;
use App\Filament\Resources\FabricImages\Schemas\FabricImageForm;
use App\Filament\Resources\FabricImages\Tables\FabricImagesTable;
use App\Models\FabricImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FabricImageResource extends Resource
{
    protected static ?string $model = FabricImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Fabrics';
    protected static ?int $navigationSort = 2; // adjust for each

    public static function form(Schema $schema): Schema
    {
        return FabricImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FabricImagesTable::configure($table);
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
            'index' => ListFabricImages::route('/'),
            'create' => CreateFabricImage::route('/create'),
            'edit' => EditFabricImage::route('/{record}/edit'),
        ];
    }
}
