<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryStainMarker extends Model
{
    protected $table = 'laundry_stain_markers';

    public $timestamps = false;

    protected $fillable = [
        'photo_id',
        'x_percent',
        'y_percent',
        'description',
    ];

    protected $casts = [
        'x_percent' => 'decimal:2',
        'y_percent' => 'decimal:2',
    ];

    public function photo()
    {
        return $this->belongsTo(LaundryOrderPhoto::class, 'photo_id');
    }
}