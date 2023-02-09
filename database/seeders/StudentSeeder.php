<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'syarif',
            'password' => bcrypt('password'),
            'role' => 'student'
        ]);
        Student::create([
            'user_id' => $user->id,
            'email' => 'syarif@gmail.com',
            'name' => 'Syarif Abdurahman',
            'university' => 'Telkom University',
            'major' => 'S1 Sistem Informasi',
            'student_id' => '1202193225',
            'gender' => 'P',
            'birth_place' => 'Bandung',
            'birth_date' => '2001-08-03',
            'phone_number' => '082130309876',
        ]);
    }
}
