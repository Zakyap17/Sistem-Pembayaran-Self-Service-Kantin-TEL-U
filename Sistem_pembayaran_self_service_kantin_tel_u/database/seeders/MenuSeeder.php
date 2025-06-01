<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'name' => 'Nasi Goreng',
            'price' => 25000,
            'description' => 'Makanan tradisional yang populer, disajikan dengan bumbu spesial.'
        ]);

        Menu::create([
            'name' => 'Mie Goreng',
            'price' => 20000,
            'description' => 'Mie goreng yang lezat dengan rasa gurih.'
        ]);

    }
}