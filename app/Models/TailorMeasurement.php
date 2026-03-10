<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TailorMeasurement extends Model
{
    protected $table = 'tailor_measurements';

    protected $fillable = [
        'booking_id',
        'chest',
        'shoulder',
        'waist',
        'hip',
        'sleeve_length',
        'trouser_length',
        'neck',
        'extra_notes',
        'unit',
    ];

    protected $casts = [
        'chest' => 'decimal:2',
        'shoulder' => 'decimal:2',
        'waist' => 'decimal:2',
        'hip' => 'decimal:2',
        'sleeve_length' => 'decimal:2',
        'trouser_length' => 'decimal:2',
        'neck' => 'decimal:2',
        'unit' => 'string',
    ];

    public function booking()
    {
        return $this->belongsTo(TailorBooking::class, 'booking_id');
    }
}