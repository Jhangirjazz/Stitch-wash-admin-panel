<?php

namespace App\Filament\Resources\TailorServices\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TailorServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                Textarea::make('description')
                    ->nullable(),
                FileUpload::make('icon_url')
                    ->image()
                    ->directory('tailor-services')
                    ->visibility('public')
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
