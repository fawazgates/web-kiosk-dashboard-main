<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'Client A',
            'address' => 'Alamat A',
            'description' => 'Deskripsi A',
            'smart_canteen' => '1',
            'smart_parking' => '1',
            'api_key' => 'BK00102KJKS',
        ]);
        Client::create([
            'name' => 'Client B',
            'address' => 'Alamat B',
            'description' => 'Deskripsi B',
            'smart_canteen' => '0',
            'smart_parking' => '0',
            'api_key' => 'CKAPI00011',
        ]);
    }
}
