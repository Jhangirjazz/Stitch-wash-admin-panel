<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FabricImage extends Model
{
    protected $table = 'fabric_images';

    protected $fillable = [
        'fabric_id',
        'image_url',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class, 'fabric_id');
    }
}