<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PromoController extends Controller
{
    // Menampilkan halaman promo dan keranjang
    public function index()
    {
        $promos = Promo::all();
        $cartItems = Cart::content();

        return view('promos.index', compact('promos', 'cartItems'));
    }

    // Menampilkan form tambah promo
    public function create()
    {
        $promo = new Promo();
        return view('promos.create', compact('promo'));
    }

    // Menyimpan data promo baru
    public function store(Request $request)
    {
        $this->validatePromo($request);

        $gambar_promo = $request->file('gambar_promo');
        $gambar_path = $this->uploadImage($gambar_promo);

        Promo::create([
            'nama_promo' => $request->input('nama_promo'),
            'gambar_promo' => $gambar_path,
            'deskripsi_promo' => $request->input('deskripsi_promo'),
            'nilai_potongan' => $request->input('nilai_potongan'),
        ]);

        return redirect()->route('promos.index')->with('success', 'Promo berhasil ditambahkan');
    }

    // Menampilkan form edit promo
    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return view('promos.edit', compact('promo'));
    }

    // Mengupdate data promo
    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);
        
        // Ubah validasi gambar_promo menjadi opsional
        $request->validate([
            'nama_promo' => 'required|string',
            'gambar_promo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_promo' => 'required|string',
            'nilai_potongan' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('gambar_promo')) {
                $promo->gambar_promo = $this->uploadImage($request->file('gambar_promo'));
            }

            $promo->update([
                'nama_promo' => $request->input('nama_promo'),
                'deskripsi_promo' => $request->input('deskripsi_promo'),
                'nilai_potongan' => $request->input('nilai_potongan'),
            ]);

            DB::commit();

            return redirect()->route('promos.index')->with('success', 'Promo berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update promo: ' . $e->getMessage());

            return redirect()->back()->withErrors('Terjadi kesalahan saat memperbarui promo');
        }
    }

    // Menghapus promo
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();

        return redirect()->route('promos.index')->with('success', 'Promo berhasil dihapus');
    }

    // Menampilkan halaman pembayaran
    public function showPaymentPage()
    {
        $promos = Promo::all();
        $cartItems = Cart::content();

        return view('payment.index', compact('promos', 'cartItems'));
    }

    public function storeOrder(Request $request)
    {
        $cartItems = Cart::content();
        $user = auth()->user(); 
        $userId = $user->id;
        $userName = $user->name; 
        $promoId = $request->input('promo_id');
        $promo = Promo::find($promoId);
        $discountPercentage = ($promo) ? $promo->nilai_potongan : 0;

        foreach ($cartItems as $item) {
            $discountAmount = ($discountPercentage / 100) * ($item->price * $item->qty);
            $totalPrice = ($item->price * $item->qty) - $discountAmount;

            Order::create([
                'menu_id' => $item->id,
                'quantity' => $item->qty,
                'name' => $userName,
                'total_price' => number_format($totalPrice, 2, '.', ''),
                'promo_id' => $promoId,
                'user_id' => $userId,
                'status' => 'Pesanan Belum Diterima',
                'discount_percentage' => $discountPercentage,
                'discount_amount' => number_format($discountAmount, 2, '.', ''),
            ]);
        }

        Cart::destroy();

        return redirect()->route('payment.success')->with('success', 'Order berhasil dibuat');
    }

    public function landingPage()
    {
        $promos = Promo::all();
        return view('landing_page.promo', compact('promos'));
    }

    // Landing page untuk pelanggan
    public function landingPageCustomer()
    {
        $promos = Promo::all();
        return view('customer.promo', compact('promos'));
    }

    // Validasi data promo
    private function validatePromo(Request $request)
    {
        return $request->validate([
            'nama_promo' => 'required|string',
            'gambar_promo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_promo' => 'required|string',
            'nilai_potongan' => 'required|numeric',
        ]);
    }

    // Upload gambar promo
    private function uploadImage($file)
    {
        $nama_file = $file->getClientOriginalName();
        return $file->storeAs('images/promo', $nama_file, 'public');
    }
}