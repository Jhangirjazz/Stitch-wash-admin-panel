<?php

namespace App\Filament\Resources\LaundryOrderStages;

use UnitEnum;
use App\Filament\Resources\LaundryOrderStages\Pages\CreateLaundryOrderStage;
use App\Filament\Resources\LaundryOrderStages\Pages\EditLaundryOrderStage;
use App\Filament\Resources\LaundryOrderStages\Pages\ListLaundryOrderStages;
use App\Filament\Resources\LaundryOrderStages\Schemas\LaundryOrderStageForm;
use App\Filament\Resources\LaundryOrderStages\Tables\LaundryOrderStagesTable;
use App\Models\LaundryOrderStage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaundryOrderStageResource extends Resource
{
    protected static ?string $model = LaundryOrderStage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Laundry Management';
    protected static ?int $navigationSort = 6; // adjust order as needed

    public static function form(Schema $schema): Schema
    {
        return LaundryOrderStageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaundryOrderStagesTable::configure($table);
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
            'index' => ListLaundryOrderStages::route('/'),
            'create' => CreateLaundryOrderStage::route('/create'),
            'edit' => EditLaundryOrderStage::route('/{record}/edit'),
        ];
    }
}
