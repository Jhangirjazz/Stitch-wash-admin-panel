<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refunds';

    protected $fillable = [
        'payment_id',
        'amount',
        'reason',
        'gateway_ref',
        'status',
        'processed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}