<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotAvailability extends Model
{
    protected $table = 'slot_availability';

    protected $fillable = [
        'time_slot_id',
        'slot_date',
        'booked_count',
        'is_blocked',
    ];

    protected $casts = [
        'slot_date' => 'date',
        'booked_count' => 'integer',
        'is_blocked' => 'boolean',
    ];

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id');
    }
}
