<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    protected $table = 'fabrics';

    protected $fillable = [
        'name',
        'fabric_code',
        'material_type',
        'color',
        'pattern',
        'price_per_meter',
        'price_per_piece',
        'currency',
        'stock_status',
        'care_instructions',
        'description',
        'is_active',
        'odoo_product_id',
    ];

    protected $casts = [
        'price_per_meter' => 'decimal:2',
        'price_per_piece' => 'decimal:2',
        'is_active' => 'boolean',
        'stock_status' => 'string',
    ];

    public function images()
    {
        return $this->hasMany(FabricImage::class, 'fabric_id');
    }

    public function favorites()
    {
        return $this->hasMany(FabricFavorite::class, 'fabric_id');
    }
}
