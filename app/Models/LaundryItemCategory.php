<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryItemCategory extends Model
{
    protected $table = 'laundry_item_categories';

    protected $fillable = [
        'service_type_id',
        'name',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function serviceType()
    {
        return $this->belongsTo(LaundryServiceType::class, 'service_type_id');
    }

    public function items()
    {
        return $this->hasMany(LaundryItem::class, 'category_id');
    }
}
