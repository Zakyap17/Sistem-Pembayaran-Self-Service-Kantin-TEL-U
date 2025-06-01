<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan halaman Dashboard
    public function showdashboard()
    {
        return view('dashboard');  // Pastikan file 'dashboard.blade.php' ada di 'resources/views'
    }

    // Menampilkan halaman Pesan Makanan
    public function pesanMakanan()
    {
        return view('pesan_makanan');  // Pastikan file 'pesan_makanan.blade.php' ada di 'resources/views'
    }

    // Menampilkan halaman Riwayat Transaksi
    public function riwayatTransaksi()
    {
        return view('riwayat_transaksi');  // Pastikan file 'riwayat_transaksi.blade.php' ada di 'resources/views'
    }

    // Menampilkan halaman Kelola Transaksi
    public function kelolaTransaksi()
    {
        return view('kelola_transaksi');  // Pastikan file 'kelola_transaksi.blade.php' ada di 'resources/views'
    }
}
