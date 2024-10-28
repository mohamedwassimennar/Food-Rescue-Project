<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\Mitra;
use App\Models\Promo;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $mitra = Mitra::where('name', $user->name)->first();
    
        if ($mitra) {
            $orderMenuIds = Order::whereHas('menu', function ($query) use ($mitra) {
                $query->where('nama_toko', $mitra->nama_toko);
            })->pluck('menu_id')->toArray();
    
            $namaTokos = Menu::whereIn('id', $orderMenuIds)->pluck('nama_toko')->unique()->toArray();
    
            $mitraNames = Mitra::whereIn('nama_toko', $namaTokos)->pluck('name')->toArray();
    

            $orders = Order::whereIn('menu_id', $orderMenuIds)->paginate(10);
    
            $menus = Menu::whereIn('id', $orderMenuIds)->get(); 
    
        } else {
            $orders = collect();
            $menus = collect();
        }
    
        return view('orders.index', compact('orders', 'menus', 'mitraNames'));
    }
    


    public function create()
    {
        $menus = Menu::all();
        $promos = Promo::all();
        $customers = User::where('role', 'customer')->get();

        return view('orders.create', compact('menus', 'promos', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'promo_id' => 'exists:promos,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::find($request->input('menu_id'));
        $promo = Promo::find($request->input('promo_id'));
        $user = User::find($request->input('user_id'));

        $stock = Stock::where('menu_id', $menu->id)->first();

        if (!$stock || $stock->quantity < $request->input('quantity')) {
            return redirect()->back()->with('error', 'Stock habis atau tidak mencukupi untuk pesanan ini');
        }


        $subtotal = $menu->harga_menu * $request->input('quantity');

        $discountAmount = ($promo) ? ($subtotal * ($promo->nilai_potongan / 100)) : 0;

        $totalPrice = $subtotal - $discountAmount;

        $order = new Order([
            'quantity' => $request->input('quantity'),
            'total_price' => $totalPrice,
            'name' => $user->name,
        ]);

        $order->menu()->associate($menu);
        $order->promo()->associate($promo);
        $order->user()->associate($user);
        $order->save();

        $stock->quantity -= $request->input('quantity');
        $stock->save();

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $menus = Menu::all();
        $promos = Promo::all();
        $customers = User::where('role', 'customer')->get();

        return view('orders.edit', compact('order', 'menus', 'promos', 'customers'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'promo_id' => 'nullable|exists:promos,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'in:Pesanan Belum Diterima,Pesanan Sedang Diproses,Pesanan Siap',
        ]);

        $menu = Menu::findOrFail($request->input('menu_id'));
        $promo = $request->input('promo_id') ? Promo::findOrFail($request->input('promo_id')) : null;
        $user = User::findOrFail($request->input('user_id'));


        $previousStatus = $order->status;

        $order->menu()->associate($menu);
        $order->promo()->associate($promo);
        $order->user()->associate($user);
        $order->quantity = $request->input('quantity');
        $order->total_price = (($menu->harga_menu * $request->input('quantity')) - ($menu->harga_menu * ($promo ? $promo->nilai_potongan : 0)));
        $order->status = $request->input('status');
        

        if (
            in_array($previousStatus, ['Pesanan Belum Diterima', 'Pesanan Siap']) &&
            in_array($request->input('status'), ['Pesanan Belum Diterima', 'Pesanan Siap'])
        ) {
            // Tidak melakukan pengurangan stok
        } else {
            // Lakukan pengurangan stok
            $stock = Stock::where('menu_id', $menu->id)->firstOrFail();
            $stock->quantity -= $request->input('quantity');
            $stock->save();
        }

        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order berhasil diupdate');
    }


    public function destroy(Order $order)
    {
        
        $menu = $order->menu;
        $quantity = $order->quantity;

        
        $stock = Stock::where('menu_id', $menu->id)->first();

        if ($stock) {
            
            $stock->quantity += $quantity;
            $stock->save();
        } else {
            
        }

        
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus dan stok dikembalikan');
    }
}