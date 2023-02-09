<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Food::create([
            'category_id' => '1',
            'canteen_id' => '1',
            'name' => 'Gado - gado',
            'description' => 'Menu makanan terfavorit di kantin ini. Dan menggunakan resep dari bahan makanan pilihan',
            'price' => '10000',
            'quantity' => '10',
            'discount' => null,
            'image' => null,
        ]);
        Food::create([
            'category_id' => '1',
            'canteen_id' => '1',
            'name' => 'Baso',
            'description' => 'Menu makanan yang cocok untuk dijadikan sebagai makanan pembuka di siang hari.',
            'price' => '15000',
            'quantity' => '10',
            'discount' => null,
            'image' => null,
        ]);
    }
}
