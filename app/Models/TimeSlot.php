<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $table = 'time_slots';

    protected $fillable = [
        'slot_type',
        'day_of_week',
        'start_time',
        'end_time',
        'max_bookings',
        'is_active',
    ];

    protected $casts = [
        'day_of_week' => 'integer',
        'max_bookings' => 'integer',
        'is_active' => 'boolean',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function availability()
    {
        return $this->hasMany(SlotAvailability::class, 'time_slot_id');
    }

    public function laundryPickupOrders()
    {
        return $this->hasMany(LaundryOrder::class, 'pickup_slot_id');
    }

    public function laundryDeliveryOrders()
    {
        return $this->hasMany(LaundryOrder::class, 'delivery_slot_id');
    }

    public function tailorBookings()
    {
        return $this->hasMany(TailorBooking::class, 'time_slot_id');
    }
}
