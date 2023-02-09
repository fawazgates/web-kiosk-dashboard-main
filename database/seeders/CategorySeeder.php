<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Kategori A',
            'description' => 'Deskripsi A',
        ]);
        Category::create([
            'name' => 'Kategori B',
            'description' => 'Deskripsi B',
        ]);
    }
}
