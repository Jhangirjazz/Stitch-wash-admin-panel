<?php

namespace App\Filament\Resources\FabricFavorites;

use App\Filament\Resources\FabricFavorites\Pages\CreateFabricFavorite;
use App\Filament\Resources\FabricFavorites\Pages\EditFabricFavorite;
use App\Filament\Resources\FabricFavorites\Pages\ListFabricFavorites;
use App\Filament\Resources\FabricFavorites\Schemas\FabricFavoriteForm;
use App\Filament\Resources\FabricFavorites\Tables\FabricFavoritesTable;
use App\Models\FabricFavorite;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FabricFavoriteResource extends Resource
{
    protected static ?string $model = FabricFavorite::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|UnitEnum|null $navigationGroup = 'Fabrics';

    protected static ?int $navigationSort = 3; // adjust for each

    public static function form(Schema $schema): Schema
    {
        return FabricFavoriteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FabricFavoritesTable::configure($table);
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
            'index' => ListFabricFavorites::route('/'),
            'create' => CreateFabricFavorite::route('/create'),
            'edit' => EditFabricFavorite::route('/{record}/edit'),
        ];
    }
}
