<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'superadmin',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
            'password_not_encrypt' => 'password',
        ]);
    }
}
