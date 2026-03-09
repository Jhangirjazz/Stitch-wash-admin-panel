<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrderItem extends Model
{
    protected $table = 'laundry_order_items';

    public $timestamps = false; // if no timestamps

    protected $fillable = [
        'order_id',
        'laundry_item_id',
        'quantity',
        'unit_price',
        'total_price',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'order_id');
    }

    public function laundryItem()
    {
        return $this->belongsTo(LaundryItem::class, 'laundry_item_id');
    }
}