<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            // General Settings
            ['key' => 'system_title', 'value' => 'Your System Title'],
            ['key' => 'system_logo', 'value' => 'path/to/logo.png'],
            ['key' => 'phone_number', 'value' => '+1234567890'],
            ['key' => 'email', 'value' => 'contact@example.com'],
            ['key' => 'currency_code', 'value' => 'USD'],
            ['key' => 'frontend_layout', 'value' => 'default'],
            ['key' => 'date_format', 'value' => 'MM/DD/YYYY'],
            ['key' => 'dedicated_ip', 'value' => '192.168.1.1'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert($setting);
        }
    }
}
