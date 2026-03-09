<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrderStage extends Model
{
    protected $table = 'laundry_order_stages';

    public $timestamps = false; // only created_at exists

    protected $fillable = [
        'order_id',
        'stage',
        'staff_id',
        'notes',
        'is_customer_visible',
    ];

    protected $casts = [
        'is_customer_visible' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'order_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}