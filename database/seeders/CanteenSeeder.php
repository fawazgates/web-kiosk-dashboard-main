<?php

namespace Database\Seeders;

use App\Models\Canteen;
use App\Models\User;
use Illuminate\Database\Seeder;

class CanteenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'canteen',
            'password' => bcrypt('password'),
            'role' => 'canteen'
        ]);
        Canteen::create([
            'user_id' => $user->id,
            'client_id' => '1',
            'name' => 'Kantin Ibuk Haji Jamiah',
            'seller_name' => 'Seller A',
            'description' => 'Description A',
            'open_from' => '10:00',
            'open_to' => '17:00',
        ]);
    }
}
