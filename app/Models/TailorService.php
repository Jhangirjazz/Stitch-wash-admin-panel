<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TailorService extends Model
{
    protected $table = 'tailor_services';

    protected $fillable = [
        'name',
        'description',
        'icon_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(TailorBooking::class, 'service_id');
    }
}