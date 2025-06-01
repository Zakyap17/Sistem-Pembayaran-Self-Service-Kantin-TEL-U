<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();  

        return view('kelola_transaksi', compact('transaksis'));
    }

    public function create()
    {
        return view('tambah_transaksi');  
    }

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

        return redirect()->route('kelola.transaksi');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        return view('edit_transaksi', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan' => 'required|string',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'pelanggan' => $request->pelanggan,
            'total' => $request->total,
            'status' => $request->status,
        ]);

        return redirect()->route('kelola.transaksi');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('kelola.transaksi');
    }
}
