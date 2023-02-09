<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SuperadminSeeder::class,
            CategorySeeder::class,
            ParkingSpotSeeder::class,
            ClientSeeder::class,
            CanteenSeeder::class,
            FoodSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
