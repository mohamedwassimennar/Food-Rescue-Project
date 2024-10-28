<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function orders()
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->get();
        return view('customer.pemesanan', compact('orders'));
    }
}