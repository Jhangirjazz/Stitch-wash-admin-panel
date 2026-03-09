<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    protected $table = 'laundry_orders';

    protected $fillable = [
        'order_number',
        'user_id',
        'service_type_id',
        'pickup_type',
        'pickup_address_id',
        'delivery_address_id',
        'pickup_slot_id',
        'pickup_slot_date',
        'delivery_slot_id',
        'delivery_slot_date',
        'promo_code_id',
        'subtotal',
        'discount_amount',
        'vat_amount',
        'delivery_fee',
        'total_amount',
        'payment_status',
        'customer_notes',
        'is_urgent',
        'current_stage',
        'odoo_order_id',
    ];

    protected $casts = [
        'pickup_slot_date' => 'date',
        'delivery_slot_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'is_urgent' => 'boolean',
        'payment_status' => 'string',
        'current_stage' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(LaundryServiceType::class, 'service_type_id');
    }

    public function pickupAddress()
    {
        return $this->belongsTo(Address::class, 'pickup_address_id');
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(Address::class, 'delivery_address_id');
    }

    public function pickupSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'pickup_slot_id');
    }

    public function deliverySlot()
    {
        return $this->belongsTo(TimeSlot::class, 'delivery_slot_id');
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }

    public function items()
    {
        return $this->hasMany(LaundryOrderItem::class, 'order_id');
    }

    public function bags()
    {
        return $this->hasMany(LaundryOrderBag::class, 'order_id');
    }

    public function stages()
    {
        return $this->hasMany(LaundryOrderStage::class, 'order_id');
    }

    public function photos()
    {
        return $this->hasMany(LaundryOrderPhoto::class, 'order_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id')->where('order_type', 'laundry');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'order_id')->where('order_type', 'laundry');
    }
}