<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TailorBooking extends Model
{
    protected $table = 'tailor_bookings';

    protected $fillable = [
        'booking_number',
        'user_id',
        'service_id',
        'address_id',
        'time_slot_id',
        'booking_date',
        'preferred_time_note',
        'customer_notes',
        'assigned_tailor_id',
        'status',
        'completion_notes',
        'odoo_lead_id',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(TailorService::class, 'service_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id');
    }

    public function assignedTailor()
    {
        return $this->belongsTo(User::class, 'assigned_tailor_id');
    }

    public function measurement()
    {
        return $this->hasOne(TailorMeasurement::class, 'booking_id');
    }
}