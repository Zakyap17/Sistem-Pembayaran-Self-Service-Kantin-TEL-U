<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        $menus = Menu::all(); 
        return view('orders.create', compact('menus')); 
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'menu' => 'required|array',
            'menu.*' => 'required|integer|min:1', 
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
                    $menu = Menu::find($menuId); 
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
}
