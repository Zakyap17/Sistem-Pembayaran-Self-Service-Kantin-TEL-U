<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan Daftar Transaksi (Read)
    public function index()
    {
        $transaksis = Transaksi::all();  // Ambil semua data transaksi
        return view('kelola_transaksi', compact('transaksis')); // Kirim data transaksi ke view
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

        return redirect()->route('kelola.transaksi');  // Redirect ke halaman kelola transaksi setelah berhasil
    }

    // Menampilkan Form Edit Transaksi (Update)
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id); // Cari transaksi berdasarkan ID
        return view('edit_transaksi', compact('transaksi'));  // Kirim data transaksi ke view edit
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

        return redirect()->route('kelola.transaksi');  // Redirect ke halaman kelola transaksi setelah berhasil
    }

    // Menghapus Transaksi (Delete)
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();  // Hapus transaksi

        return redirect()->route('kelola.transaksi');  // Redirect ke halaman kelola transaksi setelah berhasil
    }
}
