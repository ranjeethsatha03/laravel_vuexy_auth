<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table to remove existing records
        DB::table('states')->truncate();

        // Define the states to be inserted
        $states = [
            // United States
            ['state_code' => 'CA', 'state_name' => 'California', 'country_id' => 1],
            ['state_code' => 'TX', 'state_name' => 'Texas', 'country_id' => 1],
            ['state_code' => 'NY', 'state_name' => 'New York', 'country_id' => 1],

            // Canada
            ['state_code' => 'ON', 'state_name' => 'Ontario', 'country_id' => 2],
            ['state_code' => 'QC', 'state_name' => 'Quebec', 'country_id' => 2],

            // India
            ['state_code' => 'AP', 'state_name' => 'Andhra Pradesh', 'country_id' => 4],
            ['state_code' => 'AR', 'state_name' => 'Arunachal Pradesh', 'country_id' => 4],
            ['state_code' => 'AS', 'state_name' => 'Assam', 'country_id' => 4],
            ['state_code' => 'BR', 'state_name' => 'Bihar', 'country_id' => 4],
            ['state_code' => 'CH', 'state_name' => 'Chandigarh', 'country_id' => 4],
            ['state_code' => 'GA', 'state_name' => 'Goa', 'country_id' => 4],
            ['state_code' => 'GJ', 'state_name' => 'Gujarat', 'country_id' => 4],
            ['state_code' => 'HR', 'state_name' => 'Haryana', 'country_id' => 4],
            ['state_code' => 'HP', 'state_name' => 'Himachal Pradesh', 'country_id' => 4],
            ['state_code' => 'JH', 'state_name' => 'Jharkhand', 'country_id' => 4],
            ['state_code' => 'KL', 'state_name' => 'Kerala', 'country_id' => 4],
            ['state_code' => 'LA', 'state_name' => 'Ladakh', 'country_id' => 4],
            ['state_code' => 'LD', 'state_name' => 'Lakshadweep', 'country_id' => 4],
            ['state_code' => 'MP', 'state_name' => 'Madhya Pradesh', 'country_id' => 4],
            ['state_code' => 'MN', 'state_name' => 'Manipur', 'country_id' => 4],
            ['state_code' => 'ML', 'state_name' => 'Meghalaya', 'country_id' => 4],
            ['state_code' => 'MZ', 'state_name' => 'Mizoram', 'country_id' => 4],
            ['state_code' => 'NL', 'state_name' => 'Nagaland', 'country_id' => 4],
            ['state_code' => 'OR', 'state_name' => 'Odisha', 'country_id' => 4],
            ['state_code' => 'PB', 'state_name' => 'Punjab', 'country_id' => 4],
            ['state_code' => 'RJ', 'state_name' => 'Rajasthan', 'country_id' => 4],
            ['state_code' => 'SK', 'state_name' => 'Sikkim', 'country_id' => 4],
            ['state_code' => 'TN', 'state_name' => 'Tamil Nadu', 'country_id' => 4],
            ['state_code' => 'TS', 'state_name' => 'Telangana', 'country_id' => 4],
            ['state_code' => 'TR', 'state_name' => 'Tripura', 'country_id' => 4],
            ['state_code' => 'UP', 'state_name' => 'Uttar Pradesh', 'country_id' => 4],
            ['state_code' => 'UT', 'state_name' => 'Uttarakhand', 'country_id' => 4],
            ['state_code' => 'WB', 'state_name' => 'West Bengal', 'country_id' => 4],

            // Australia
            ['state_code' => 'NSW', 'state_name' => 'New South Wales', 'country_id' => 5],
            ['state_code' => 'VIC', 'state_name' => 'Victoria', 'country_id' => 5],

            // Add more states for other countries as needed
        ];

        // Insert the records into the table
        DB::table('states')->insert($states);
    }
}
