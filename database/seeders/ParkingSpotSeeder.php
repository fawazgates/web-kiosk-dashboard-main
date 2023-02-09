<?php

namespace Database\Seeders;

use App\Models\ParkingSpot;
use Illuminate\Database\Seeder;

class ParkingSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParkingSpot::create([
            'code' => 'B001002300',
            'location' => 'Lokasi A',
            'name' => 'Parking Spot A',
            'total_transaction' => '5',
        ]);
        ParkingSpot::create([
            'code' => 'B001002300',
            'location' => 'Lokasi B',
            'name' => 'Parking Spot B',
            'total_transaction' => '10',
        ]);
    }
}
