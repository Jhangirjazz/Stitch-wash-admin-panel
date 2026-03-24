<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $table = 'system_settings';

    protected $fillable = [
        'setting_key',
        'setting_value',
        'group_id',
    ];

    protected $casts = [
        'group_id' => 'integer',
    ];

    public function group()
    {
        return $this->belongsTo(SettingGroup::class, 'group_id');
    }

    // Helper method to get setting value
    public static function get($key, $default = null)
    {
        $setting = self::where('setting_key', $key)->first();
        return $setting ? $setting->setting_value : $default;
    }

    // Helper method to set setting value
    public static function set($key, $value, $groupId = null)
    {
        return self::updateOrCreate(
            ['setting_key' => $key],
            ['setting_value' => $value, 'group_id' => $groupId]
        );
    }
}