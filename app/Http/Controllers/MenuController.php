<?php

namespace App\Http\Controllers;

// app/Http/Controllers/MenuController.php

use App\Models\Menu;
use App\Models\Stock;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mitra = Mitra::where('name', $user->name)->first();

        if ($mitra) {
            $menus = Menu::where('nama_toko', $mitra->nama_toko)->simplePaginate(5);
        } else {
            $menus = collect();
        }

        return view('menus.index', compact('menus'));

    }

    public function create()
    {
        $user = Auth::user();
        $mitra = Mitra::where('name', $user->name)->first();
        return view('menus.create', compact('mitra'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_menu' => 'required',
            'kategori_menu' => 'required',
            'gambar_menu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga_menu' => 'required|numeric',
        ]);

        $menu = new Menu();
        $menu->nama_menu = $request->input('nama_menu');
        $menu->nama_toko = $request->input('nama_toko');
        $menu->kategori_menu = $request->input('kategori_menu');


        $gambar_menu = $request->file('gambar_menu');
        $gambar_menu_path = $gambar_menu->storeAs('images/menu', $gambar_menu->getClientOriginalName(), 'public');
        $menu->gambar_menu = $gambar_menu_path;

        $menu->harga_menu = $request->input('harga_menu');
        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        return view('menus.show', compact('menu'));
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_menu' => 'required',
            'kategori_menu' => 'required',
            'harga_menu' => 'required|numeric',
        ]);

        $menu = Menu::find($id);
        $menu->nama_menu = $request->input('nama_menu');
        $menu->kategori_menu = $request->input('kategori_menu');

        if ($request->hasFile('gambar_menu')) {

            Storage::disk('public')->delete($menu->gambar_menu);


            $gambar_menu = $request->file('gambar_menu');
            $gambar_menu_path = $gambar_menu->storeAs('images/menu', $gambar_menu->getClientOriginalName(), 'public');
            $menu->gambar_menu = $gambar_menu_path;
        }

        $menu->harga_menu = $request->input('harga_menu');
        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);

 
        Storage::disk('public')->delete($menu->gambar_menu);

        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus');
    }
    public function landingPage()
    {
        $menus = Menu::all();
        $stocks = Stock::all();

        return view('landing_page.menu', compact('menus','stocks'));
    }
    public function landingPageCustomer()
    {
        $menus = Menu::all();
        $stocks = Stock::all();

        return view('customer.menu', compact('menus','stocks'));
    }
    
    public function addToCart(Request $request)
    {
        $menu = Menu::find($request->menu_id);
    
        Cart::add([
            'id' => $menu->id,
            'name' => $menu->nama_menu,
            'qty' => 1,
            'price' => $menu->harga_menu,
            'options' => ['image' => $menu->gambar_menu],
        ]);
    
        return redirect()->back()->with('success', 'Item added to cart');
    }
}