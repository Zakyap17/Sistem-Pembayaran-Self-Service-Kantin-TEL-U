<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan Anda mengimpor model User

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data pengguna manual
        User::create([
            'name' => 'Zaky Aprilian',
            'email' => 'zakyaprilian17@gmail.com',
            'password' => bcrypt('171717'), // Pastikan password di-hash
        ]);

        User::create([
            'name' => 'Zakiy Muhahid',
            'email' => 'zakiymujahid29@gmail.com',
            'password' => bcrypt('292929'), // Pastikan password di-hash
        ]);

        // Anda dapat menambahkan lebih banyak pengguna jika diperlukan
    }
}
