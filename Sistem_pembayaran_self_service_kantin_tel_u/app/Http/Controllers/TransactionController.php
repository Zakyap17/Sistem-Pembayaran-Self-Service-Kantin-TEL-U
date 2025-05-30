<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // READ: Tampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::with(['user', 'order'])->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    // CREATE: Form tambah transaksi
    public function create()
    {
        return view('transactions.create');
    }

    // CREATE: Simpan transaksi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'user_id' => 'required|exists:users,user_id',
            'payment_method' => 'required|in:cash,e-wallet,bank_transfer',
            'status' => 'required|in:pending,success,failed',
            'amount' => 'required|numeric|min:0'
        ]);

        Transaction::create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // READ: Tampilkan detail transaksi
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    // UPDATE: Form edit transaksi
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    // UPDATE: Simpan perubahan
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,e-wallet,bank_transfer',
            'status' => 'required|in:pending,success,failed',
            'amount' => 'required|numeric|min:0'
        ]);

        $transaction->update($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    // DELETE: Hapus transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}