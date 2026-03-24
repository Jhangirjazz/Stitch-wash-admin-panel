<?php

namespace App\Filament\Resources\SystemSettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SystemSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('setting_key')
                    ->label('Setting Key')
                    ->required()
                    ->maxLength(150)
                    ->unique(ignoreRecord: true)
                    ->helperText('Unique identifier for this setting (e.g., vat_rate_percent)'),
                Textarea::make('setting_value')
                    ->label('Setting Value')
                    ->nullable()
                    ->helperText('The value for this setting'),
                Select::make('group_id')
                    ->relationship('group', 'name')
                    ->label('Group')
                    ->placeholder('Select a group')
                    ->searchable()
                    ->preload()
                    ->nullable(),
            ]);
    }
}