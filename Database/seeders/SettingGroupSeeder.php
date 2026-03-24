<?php

namespace Database\Seeders;

use App\Models\SettingGroup;
use Illuminate\Database\Seeder;

class SettingGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'Pricing', 'slug' => 'pricing', 'sort_order' => 1],
            ['name' => 'Notifications', 'slug' => 'notifications', 'sort_order' => 2],
            ['name' => 'Operations', 'slug' => 'operations', 'sort_order' => 3],
            ['name' => 'Contact', 'slug' => 'contact', 'sort_order' => 4],
            ['name' => 'General', 'slug' => 'general', 'sort_order' => 5],
        ];

        foreach ($groups as $group) {
            SettingGroup::updateOrCreate(
                ['slug' => $group['slug']],
                $group
            );
        }
    }
}