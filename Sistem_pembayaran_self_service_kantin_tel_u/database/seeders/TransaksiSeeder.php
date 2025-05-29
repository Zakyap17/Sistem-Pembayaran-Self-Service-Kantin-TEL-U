<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data transaksi
        Transaksi::create([
            'pelanggan' => 'Jane Doe',
            'total' => 75000,
            'status' => 'Completed'
        ]);

        Transaksi::create([
            'pelanggan' => 'Michael Smith',
            'total' => 120000,
            'status' => 'Pending'
        ]);

        Transaksi::create([
            'pelanggan' => 'Alice Johnson',
            'total' => 85000,
            'status' => 'Completed'
        ]);
    }
}
