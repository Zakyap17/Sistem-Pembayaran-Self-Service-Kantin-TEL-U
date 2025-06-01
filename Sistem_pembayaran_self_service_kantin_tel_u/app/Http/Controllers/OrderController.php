<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = \App\Models\Menu::all();
        return view('orders.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->status = 'pending';
        $order->total_amount = 0;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {        
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'Tidak bisa mengedit pesanan ini.');
        }

        return view('orders.edit', compact('order'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'Tidak bisa mengubah pesanan ini.');
        }

        $order->total_amount = $request->input('total_amount', 0);
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'Tidak bisa membatalkan pesanan ini.');
        }
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
