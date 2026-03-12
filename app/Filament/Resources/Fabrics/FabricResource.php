<?php

namespace App\Filament\Resources\Fabrics;

use App\Filament\Resources\Fabrics\Pages\CreateFabric;
use App\Filament\Resources\Fabrics\Pages\EditFabric;
use App\Filament\Resources\Fabrics\Pages\ListFabrics;
use App\Filament\Resources\Fabrics\Schemas\FabricForm;
use App\Filament\Resources\Fabrics\Tables\FabricsTable;
use App\Models\Fabric;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FabricResource extends Resource
{
    protected static ?string $model = Fabric::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Fabrics';

    protected static ?int $navigationSort = 1; // adjust for each

    public static function form(Schema $schema): Schema
    {
        return FabricForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FabricsTable::configure($table);
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
            'index' => ListFabrics::route('/'),
            'create' => CreateFabric::route('/create'),
            'edit' => EditFabric::route('/{record}/edit'),
        ];
    }
}
