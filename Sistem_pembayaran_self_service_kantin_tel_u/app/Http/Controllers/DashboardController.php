<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showdashboard()
    {
        return view('dashboard'); 
    }

    public function pesanMakanan()
    {
        return view('pesan_makanan'); 
    }

    public function riwayatTransaksi()
    {
        return view('riwayat_transaksi');  
    }

    public function kelolaTransaksi()
    {
        return view('kelola_transaksi'); 
    }
}
