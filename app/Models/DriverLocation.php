<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverLocation extends Model
{
    protected $table = 'driver_locations';

    public $timestamps = false; // we use recorded_at

    protected $fillable = [
        'driver_id',
        'latitude',
        'longitude',
        'speed_kmh',
        'heading',
        'recorded_at',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'speed_kmh' => 'decimal:2',
        'heading' => 'decimal:2',
        'recorded_at' => 'datetime',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
