<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transactions';

    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'reference_type',
        'reference_id',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function wallet()
    {
        return $this->belongsTo(CustomerWallet::class, 'wallet_id');
    }

    public function reference()
    {
        return $this->morphTo();
    }
}