<?php

namespace App\Filament\Resources\WalletTransactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\CustomerWallet;

class WalletTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wallet_id')
                    ->label('Wallet')
                    ->options(function () {
                        return CustomerWallet::with('user')
                            ->get()
                            ->mapWithKeys(function ($wallet) {
                                $userName = $wallet->user?->name ?? 'Deleted User';
                                $balance = number_format($wallet->balance, 2);
                                $currency = $wallet->currency ?? 'AED';
                                $label = "{$userName} - Balance: {$balance} {$currency}";
                                return [$wallet->id => $label];
                            });
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('type')
                    ->options([
                        'credit' => 'Credit',
                        'debit' => 'Debit',
                    ])
                    ->required(),
                TextInput::make('amount')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
                Select::make('reference_type')
                    ->options([
                        'order' => 'Order',
                        'payment' => 'Payment',
                        'refund' => 'Refund',
                        'manual' => 'Manual Adjustment',
                    ])
                    ->nullable(),
                TextInput::make('reference_id')
                    ->numeric()
                    ->nullable(),
                TextInput::make('description')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }
}