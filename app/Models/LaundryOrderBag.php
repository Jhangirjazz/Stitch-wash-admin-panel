<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrderBag extends Model
{
    protected $table = 'laundry_order_bags';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'bag_number',
        'item_count',
        'extra_items',
        'bag_price',
        'extra_charge',
    ];

    protected $casts = [
        'bag_number' => 'integer',
        'item_count' => 'integer',
        'extra_items' => 'integer',
        'bag_price' => 'decimal:2',
        'extra_charge' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'order_id');
    }
}
