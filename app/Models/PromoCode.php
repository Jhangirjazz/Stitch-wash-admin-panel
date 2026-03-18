<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $table = 'promo_codes';

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'max_discount_cap',
        'max_uses_total',
        'max_uses_per_user',
        'used_count',
        'valid_from',
        'valid_until',
        'applicable_to',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount_cap' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];
}