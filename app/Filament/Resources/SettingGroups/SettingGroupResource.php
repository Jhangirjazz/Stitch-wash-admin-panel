<?php

namespace App\Filament\Resources\SettingGroups;

use UnitEnum;
use App\Filament\Resources\SettingGroups\Pages\CreateSettingGroup;
use App\Filament\Resources\SettingGroups\Pages\EditSettingGroup;
use App\Filament\Resources\SettingGroups\Pages\ListSettingGroups;
use App\Filament\Resources\SettingGroups\Schemas\SettingGroupForm;
use App\Filament\Resources\SettingGroups\Tables\SettingGroupsTable;
use App\Models\SettingGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SettingGroupResource extends Resource
{
    protected static ?string $model = SettingGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SettingGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingGroupsTable::configure($table);
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
            'index' => ListSettingGroups::route('/'),
            'create' => CreateSettingGroup::route('/create'),
            'edit' => EditSettingGroup::route('/{record}/edit'),
        ];
    }
}
