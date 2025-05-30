<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteMenu;
// use App\Models\Menu; // Uncomment jika diperlukan di method lain

class DashboardController extends Controller
{
    public function showdashboard()
    {
        $favoriteMenus = FavoriteMenu::with('menu')
                            ->orderBy('rank', 'asc')
                            ->get();
        
        return view('dashboard', compact('favoriteMenus'));
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