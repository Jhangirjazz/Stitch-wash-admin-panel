<?php

namespace App\Filament\Resources\SettingGroups\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SettingGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => 
                        $set('slug', str()->slug($state))
                    ),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true),
                Textarea::make('description')
                    ->nullable()
                    ->maxLength(65535),
                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}