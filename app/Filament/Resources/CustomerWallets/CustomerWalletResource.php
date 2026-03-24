<?php

namespace App\Filament\Resources\CustomerWallets;

use UnitEnum;
use App\Filament\Resources\CustomerWallets\Pages\CreateCustomerWallet;
use App\Filament\Resources\CustomerWallets\Pages\EditCustomerWallet;
use App\Filament\Resources\CustomerWallets\Pages\ListCustomerWallets;
use App\Filament\Resources\CustomerWallets\Schemas\CustomerWalletForm;
use App\Filament\Resources\CustomerWallets\Tables\CustomerWalletsTable;
use App\Models\CustomerWallet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CustomerWalletResource extends Resource
{
    protected static ?string $model = CustomerWallet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWallet;
    protected static string|UnitEnum|null $navigationGroup = 'Payments';
    protected static ?int $navigationSort = 1; // adjust order

    public static function form(Schema $schema): Schema
    {
        return CustomerWalletForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerWalletsTable::configure($table);
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
            'index' => ListCustomerWallets::route('/'),
            'create' => CreateCustomerWallet::route('/create'),
            'edit' => EditCustomerWallet::route('/{record}/edit'),
        ];
    }
}
