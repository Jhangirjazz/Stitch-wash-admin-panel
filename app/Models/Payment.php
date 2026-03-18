<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'payment_reference',
        'order_type',
        'order_id',
        'user_id',
        'amount',
        'currency',
        'payment_method',
        'gateway',
        'gateway_ref',
        'status',
        'gateway_response',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'gateway_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->morphTo();
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}