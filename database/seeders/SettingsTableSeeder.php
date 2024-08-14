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

            // Payment Settings
            ['key' => 'active_payment_gateway', 'value' => 'stripe'],
            ['key' => 'stripe_credentials', 'value' => 'your-stripe-key'],
            ['key' => 'paypal_credentials', 'value' => 'your-paypal-key'],
            ['key' => 'razorpay_credentials', 'value' => 'your-razorpay-key'],
            ['key' => 'paystack_credentials', 'value' => 'your-paystack-key'],
            ['key' => 'paydunya_credentials', 'value' => 'your-paydunya-key'],

            // SEO Settings
            ['key' => 'meta_title', 'value' => 'Your Meta Title'],
            ['key' => 'meta_description', 'value' => 'Your Meta Description'],
            ['key' => 'og_title', 'value' => 'Your OG Title'],
            ['key' => 'og_description', 'value' => 'Your OG Description'],
            ['key' => 'og_image', 'value' => 'path/to/og_image.png'],

            // Analytics Settings
            ['key' => 'google_analytics', 'value' => 'your-google-analytics-id'],
            ['key' => 'facebook_pixel', 'value' => 'your-facebook-pixel-id'],
            ['key' => 'chat_script', 'value' => 'your-chat-script'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert($setting);
        }
    }
}
