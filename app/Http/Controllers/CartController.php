<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Promo; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        $promos = Promo::all();
        return view('cart.index', compact('cartItems', 'promos'));
    }
    public function clearCart()
    {
        Cart::destroy(); 

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully');
    }
    public function destroy($rowId)
    {
        Cart::remove($rowId); 
        return redirect()->route('cart.index')->with('success', 'Item removed successfully');
    }
    public function update(Request $request, $rowId)
    {
        $item = Cart::get($rowId);
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }

        $action = $request->input('action');
        \Log::info('Update cart item', ['rowId' => $rowId, 'action' => $action]);

        if ($action == 'increase') {
            Cart::update($rowId, $item->qty + 1);
        } elseif ($action == 'decrease') {
            if ($item->qty > 1) {
                Cart::update($rowId, $item->qty - 1);
            } else {
                return response()->json(['success' => false, 'message' => 'Quantity cannot be less than 1']);
            }
        }

        return response()->json(['success' => true]);
    }

}