<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    protected $table = 'service_areas';

    protected $fillable = [
        'name',
        'city',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}