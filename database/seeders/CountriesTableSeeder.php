<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate the table to remove existing records
        DB::table('countries')->truncate();

        // Define the countries to be inserted
        $countries = [
            ['areacountry' => 'US', 'country_name' => 'United States', 'phone_code' => '+1', 'currency_code' => 'USD'],
            ['areacountry' => 'CA', 'country_name' => 'Canada', 'phone_code' => '+1', 'currency_code' => 'CAD'],
            ['areacountry' => 'GB', 'country_name' => 'United Kingdom', 'phone_code' => '+44', 'currency_code' => 'GBP'],
            ['areacountry' => 'IN', 'country_name' => 'India', 'phone_code' => '+91', 'currency_code' => 'INR'],
            ['areacountry' => 'AU', 'country_name' => 'Australia', 'phone_code' => '+61', 'currency_code' => 'AUD'],
            ['areacountry' => 'DE', 'country_name' => 'Germany', 'phone_code' => '+49', 'currency_code' => 'EUR'],
            ['areacountry' => 'FR', 'country_name' => 'France', 'phone_code' => '+33', 'currency_code' => 'EUR'],
            ['areacountry' => 'JP', 'country_name' => 'Japan', 'phone_code' => '+81', 'currency_code' => 'JPY'],
            ['areacountry' => 'CN', 'country_name' => 'China', 'phone_code' => '+86', 'currency_code' => 'CNY'],
            ['areacountry' => 'BR', 'country_name' => 'Brazil', 'phone_code' => '+55', 'currency_code' => 'BRL'],
            ['areacountry' => 'ZA', 'country_name' => 'South Africa', 'phone_code' => '+27', 'currency_code' => 'ZAR'],
            ['areacountry' => 'IT', 'country_name' => 'Italy', 'phone_code' => '+39', 'currency_code' => 'EUR'],
            ['areacountry' => 'RU', 'country_name' => 'Russia', 'phone_code' => '+7', 'currency_code' => 'RUB'],
            ['areacountry' => 'MX', 'country_name' => 'Mexico', 'phone_code' => '+52', 'currency_code' => 'MXN'],
            ['areacountry' => 'KR', 'country_name' => 'South Korea', 'phone_code' => '+82', 'currency_code' => 'KRW'],
            ['areacountry' => 'NG', 'country_name' => 'Nigeria', 'phone_code' => '+234', 'currency_code' => 'NGN'],
            ['areacountry' => 'AR', 'country_name' => 'Argentina', 'phone_code' => '+54', 'currency_code' => 'ARS'],
        ];

        // Insert the records into the table
        DB::table('countries')->insert($countries);
    }
}
