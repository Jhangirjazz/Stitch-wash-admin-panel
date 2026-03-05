<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->nullable()
                    ->unique(ignoreRecord: true),
                DateTimePicker::make('email_verified_at')
                    ->nullable(),
                TextInput::make('phone')
                    ->tel()
                    ->nullable()
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->visible(fn (string $context): bool => $context === 'create' || auth()->user()?->role === 'admin'),
                FileUpload::make('profile_photo_url')
                    ->image()
                    ->directory('profile-photos')
                    ->visibility('public')
                    ->nullable(),
                Select::make('role')
                    ->options([
                        'customer' => 'Customer',
                        'admin' => 'Admin',
                        'driver' => 'Driver',
                        'laundry_staff' => 'Laundry staff',
                        'tailor_staff' => 'Tailor staff',
                    ])
                    ->default('customer')
                    ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->required(),
                TextInput::make('fcm_token')
                    ->maxLength(500)
                    ->visibleOn('edit')
                    ->nullable(),
                DateTimePicker::make('last_login_at')
                    ->nullable()
                    ->disabled()
                    ->visibleOn('edit'),
            ]);
    }
}
