<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryServiceType extends Model
{
    protected $table = 'laundry_service_types';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon_url',
        'bag_color',
        'pricing_model',
        'bag_price',
        'bag_capacity_kg',
        'bag_max_items',
        'extra_item_price',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'bag_price' => 'decimal:2',
        'bag_capacity_kg' => 'decimal:2',
        'extra_item_price' => 'decimal:2',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        // 'created_at' => 'datetime',
        // 'updated_at' => 'datetime',
    ];

    /**
     * Get the categories for this service type.
     */
    public function categories()
    {
        return $this->hasMany(LaundryItemCategory::class, 'service_type_id');
    }

    /**
     * Get the orders for this service type.
     */
    public function orders()
    {
        return $this->hasMany(LaundryOrder::class, 'service_type_id');
    }
}
