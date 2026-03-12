<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryItem extends Model
{
    protected $table = 'laundry_items';

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'currency',
        'icon_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(LaundryItemCategory::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(LaundryOrderItem::class, 'laundry_item_id');
    }
}
