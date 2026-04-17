<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['group' => 'appSettings', 'name' => 'app_name', 'payload' => json_encode('GoodFood'), 'locked' => false],
            ['group' => 'appSettings', 'name' => 'app_logo', 'payload' => json_encode(''), 'locked' => false],
            ['group' => 'appSettings', 'name' => 'app_favicon', 'payload' => json_encode(''), 'locked' => false],
            ['group' => 'appSettings', 'name' => 'commission_percentage', 'payload' => json_encode(10), 'locked' => false],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['group' => $setting['group'], 'name' => $setting['name']],
                ['payload' => $setting['payload'], 'locked' => $setting['locked']],
            );
        }
    }
}
