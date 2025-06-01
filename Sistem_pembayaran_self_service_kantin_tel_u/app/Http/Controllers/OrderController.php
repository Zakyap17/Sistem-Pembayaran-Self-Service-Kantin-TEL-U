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
        $orders = Order::with('details.menu')->where('user_id', Auth::id())->get();
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
        $request->validate([
            'menu' => 'required|array',
        ]);

        \DB::beginTransaction();

        try {
            $order = new Order();
            $order->user_id = Auth::id();
            $order->status = 'pending';
            $order->total_amount = 0;
            $order->save();

            $total = 0;

            foreach ($request->menu as $menuId => $qty) {
                if ($qty > 0) {
                    $menu = \App\Models\Menu::find($menuId);
                    $subtotal = $menu->price * $qty;

                    $order->details()->create([
                        'menu_id' => $menuId,
                        'quantity' => $qty,
                        'subtotal' => $subtotal,
                    ]);

                    $total += $subtotal;
                }
            }

            $order->total_amount = $total;
            $order->save();

            \DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
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
