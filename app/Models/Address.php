<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    // Disable timestamps because only 'created_at' exists (no updated_at)
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'label',
        'address_line1',
        'address_line2',
        'area',
        'city',
        'emirate',
        'country',
        'latitude',
        'longitude',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laundryOrdersPickup()
    {
        return $this->hasMany(LaundryOrder::class, 'pickup_address_id');
    }

    public function laundryOrdersDelivery()
    {
        return $this->hasMany(LaundryOrder::class, 'delivery_address_id');
    }

    public function tailorBookings()
    {
        return $this->hasMany(TailorBooking::class, 'address_id');
    }
}