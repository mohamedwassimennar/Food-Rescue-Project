<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class RestaurantController extends Controller
{
    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'restaurant_name' => 'required',
                'restaurant_phone' => 'required',
                'owner_name' => 'required',
                'cuisine_type' => 'required',
                'restaurant_address' => 'required',
            ]);

            $restaurant = new Restaurant();
            $restaurant->restaurant_name = $request->restaurant_name;
            $restaurant->restaurant_phone = $request->restaurant_phone;
            $restaurant->owner_name = $request->owner_name;
            $restaurant->cuisine_type = $request->cuisine_type;
            $restaurant->restaurant_address = $request->restaurant_address;
            
            // dd($restaurant);
            $restaurant->save();

            Session::flash('success', 'Restaurant registration successful.');


            return redirect()->route('customer.dashboard');
        }

    public function index()
        {
            $restaurants = Restaurant::where('status', 'PENDING')->get();
            return view('admin.list_restaurant.verifikasi', compact('restaurants'));
        }

    public function show($id)
        {
            $restaurant = Restaurant::where('status', 'PENDING')->findOrFail($id);
            return view('admin.list_restaurant.show', compact('restaurant'));
        }
    public function accept($id)
        {
            $restaurant = Restaurant::findOrFail($id);
    

            $restaurant->status = 'ACCEPT';
            $restaurant->save();
    

            $user = User::where('name', $restaurant->owner_name)->first();
            if ($user) {
                $user->role = 'restaurant';  
                $user->save();
            }
    
            return redirect()->route('admin.dashboard')->with('success', 'Restaurant successfully accepted and user role updated.');
        }
    public function create()
        {
            $user = auth()->user();
            $restaurant = Restaurant::where('user_id', $user->id)->first();
            return view('menus.create', compact('restaurant'));
        }

    public function listRestaurantNames()
        {
            $restaurants = Restaurant::all(['restaurant_name']);
            return view('menus.create', compact('restaurants'));
        }
    public function dataRestaurantNames()
        {
            $restaurants = Restaurant::where('status', 'ACCEPT')->get();
            return view('admin.daftar_restaurant.index', compact('restaurants'));
        }
}