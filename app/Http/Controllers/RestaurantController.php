<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\User;

class RestaurantController extends Controller
{

    public function edit(Restaurant $restaurant)
    {
        $restaurant = auth()->user()->restaurant;
        \Log::info('Restaurant data:', $restaurant->toArray());
        return view('restaurant.edit', compact('restaurant'));
    }

    public function update(Request $request)
    {
        \Log::info('Request data:', $request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:restaurants,name,' . auth()->user()->restaurant->id,
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'cuisine_type' => 'nullable|string|max:255',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i|after:opening_time',
        ]);
        \Log::info('Validated data:', $validated);

        $restaurant = auth()->user()->restaurant;

        foreach ($validated as $key => $value) {
            $restaurant->{$key} = $value;
        }

        \Log::info('Restaurant data before save:', $restaurant->toArray());
        \Log::info('Is restaurant dirty?', ['dirty' => $restaurant->isDirty()]);
        \Log::info('Changed attributes:', $restaurant->getDirty());

        if ($restaurant->isDirty()) {
            $restaurant->save();
            \Log::info('Restaurant data after save:', $restaurant->fresh()->toArray());
            return redirect()->route('restaurant.edit')
                ->with('success', 'Restaurant updated successfully');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No changes were made to the restaurant.');
        }
    }

    public function indexunverified()
    {
        $restaurants = Restaurant::where('status', 'PENDING')
            ->with('user')
            ->get();

        return view('admin.list_restaurant.verify', compact('restaurants'));
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
        \Log::info('Restaurant status updated:', $restaurant->toArray());

        $restaurants = Restaurant::where('status', 'PENDING')->with('user')->get();
        return view('admin.list_restaurant.verify', compact('restaurants'))
            ->with('success', 'Restaurant successfully accepted and user role updated.');
    }

    public function create()
    {
        $user = auth()->user();
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        return view('menus.create', compact('restaurant'));
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $user = User::where('id', $restaurant->user_id)->first();
        if ($user) {
            $user->delete();
        }

        $restaurant->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Restaurant and associated user account have been deleted.');
    }
}
