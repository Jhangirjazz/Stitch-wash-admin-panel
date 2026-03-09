<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FabricFavorite extends Model
{
    protected $table = 'fabric_favorites';

    // only created_at exists, so disable timestamps or handle manually
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'fabric_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fabric()
    {
        return $this->belongsTo(Fabric::class, 'fabric_id');
    }
}   