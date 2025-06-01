<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan Daftar Transaksi (Read)
    public function index()
    {
        // Mengambil semua data transaksi
        $transaksis = Transaksi::all();  
        
        // Mengirimkan data transaksi ke view
        return view('kelola_transaksi', compact('transaksis'));
    }

    // Menampilkan Form Tambah Transaksi (Create)
    public function create()
    {
        return view('tambah_transaksi');  // Ganti dengan view form tambah transaksi
    }

    // Menyimpan Transaksi Baru (Create)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pelanggan' => 'required|string',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Simpan transaksi ke database
        Transaksi::create([
            'pelanggan' => $request->pelanggan,
            'total' => $request->total,
            'status' => $request->status,
        ]);

        // Redirect ke halaman kelola transaksi setelah berhasil
        return redirect()->route('kelola.transaksi');
    }

    // Menampilkan Form Edit Transaksi (Update)
    public function edit($id)
    {
        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        
        // Kirim data transaksi ke view edit
        return view('edit_transaksi', compact('transaksi'));
    }

    // Mengupdate Transaksi (Update)
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'pelanggan' => 'required|string',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Cari transaksi berdasarkan ID dan update
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'pelanggan' => $request->pelanggan,
            'total' => $request->total,
            'status' => $request->status,
        ]);

        // Redirect ke halaman kelola transaksi setelah berhasil
        return redirect()->route('kelola.transaksi');
    }

    // Menghapus Transaksi (Delete)
    public function destroy($id)
    {
        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        
        // Hapus transaksi
        $transaksi->delete();

        // Redirect ke halaman kelola transaksi setelah berhasil
        return redirect()->route('kelola.transaksi');
    }
}
