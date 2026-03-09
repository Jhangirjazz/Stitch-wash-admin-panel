<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrderPhoto extends Model
{
    protected $table = 'laundry_order_photos';

    public $timestamps = false; // only created_at

    protected $fillable = [
        'order_id',
        'stage_id',
        'photo_type',
        'file_url',
        'thumbnail_url',
        'uploaded_by',
        'caption',
    ];

    protected $casts = [
        'photo_type' => 'string',
    ];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class, 'order_id');
    }

    public function stage()
    {
        return $this->belongsTo(LaundryOrderStage::class, 'stage_id');
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function stainMarkers()
    {
        return $this->hasMany(LaundryStainMarker::class, 'photo_id');
    }
}