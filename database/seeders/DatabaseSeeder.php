<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Court; // Include the Court model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insert court data
        Court::create([
            'court_name' => 'Court 1',
            'location' => 'Karachi',
            'capacity' => 5,
            'price_per_hour' => 100,
        ]);

        Court::create([
            'court_name' => 'Court 2',
            'location' => 'Karachi',
            'capacity' => 6,
            'price_per_hour' => 150,
        ]);

        // Add more courts as needed
    }
}
