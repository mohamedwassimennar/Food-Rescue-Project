<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
{
    session()->flash('success', 'Pembayaran berhasil!');

    $latestOrder = Order::latest()->first();

    
    if ($latestOrder && $latestOrder->items) {

        foreach ($latestOrder->items as $item) {
            $menu = $item->menu;
            $stock = Stock::where('menu_id', $menu->id)->first();

            if ($stock) {

                $stock->quantity -= $item->quantity;


                if ($stock->quantity < 0) {
                    $stock->quantity = 0;
                }


                $stock->save();
            }
        }
    }


    return redirect()->route('cart.index')->with('success', 'Pembayaran berhasil!');
}
}