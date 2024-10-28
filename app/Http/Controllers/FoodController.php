<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FoodExport;

class FoodController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $food = Food::with('restaurant')->where('restaurant_id', $user->restaurant_id)->get();
        return view('food.index', compact('food'));
    }

    public function allFood()
    {
        $food = Food::paginate(6);
        return view('admin.list_food.show', compact('food'));
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->restaurant_id) {
            return redirect()->back()->with('error', 'You are not associated with any restaurant.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:food,name,NULL,id,restaurant_id,' . $user->restaurant_id,
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expired_date' => 'required|date|after:today',
            'calories' => 'required|numeric',
            'fats' => 'required|numeric',
            'carbs' => 'required|numeric',
            'proteins' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $food = new Food;
        $food->restaurant_id = $user->restaurant_id;
        $food->name = $request->name;
        $food->description = $request->description;
        $food->image = $request->file('image')->store('foods', 'public');
        $food->expired_date = $request->expired_date;
        $food->calories = $request->calories;
        $food->fats = $request->fats;
        $food->carbs = $request->carbs;
        $food->proteins = $request->proteins;
        $food->save();

        return redirect()->route('food.index')->with('success', 'Food item has been added successfully.');
    }

    public function show($id)
    {
        $this->validate(request(), [
            'id' => 'required|integer',
        ]);

        $food = Food::with('restaurant')->findOrFail($id);
        return view('food.show', compact('food'));
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('food.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->restaurant_id && $user->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not associated with any restaurant.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:food,name,' . $id . ',id,restaurant_id,' . $user->restaurant_id,
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expired_date' => 'required|date|after:today',
            'calories' => 'required|numeric',
            'fats' => 'required|numeric',
            'carbs' => 'required|numeric',
            'proteins' => 'required|numeric',
        ]);

        Log::info($user);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $food = Food::findOrFail($id);

        if ($food->restaurant_id !== $user->restaurant_id && $user->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to update this food item.');
        }

        $food->name = $request->name;
        $food->description = $request->description;
        $food->expired_date = $request->expired_date;
        $food->calories = $request->calories;
        $food->fats = $request->fats;
        $food->carbs = $request->carbs;
        $food->proteins = $request->proteins;

        if ($request->hasFile('image')) {
            $food->image = $request->file('image')->store('foods', 'public');
        }

        $food->save();

        if ($user->role === 'admin') {
            session()->flash('success', 'Food item has been updated successfully.');
            return redirect()->route('list_food');
        }
        return redirect()->route('food.index')->with('success', 'Food item has been updated successfully.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $food = Food::findOrFail($id);

        if ($food->restaurant_id !== $user->restaurant_id && $user->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to delete this food item.');
        }

        $food->delete();

        if ($user->role === 'admin') {
            session()->flash('success', 'Food item has been deleted successfully.');
            return redirect()->route('list_food');
        }

        return redirect()->route('food.index')->with('success', 'Food item has been deleted successfully.');
    }

    public function home()
    {
        $food = Food::with('restaurant')->distinct('name')->take(6)->get();
        return view('landing_page.home', compact('food', 'food'));
    }

    public function adminEdit($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.list_food.edit', compact('food'));
    }

    public function exportExcel()
    {
        return Excel::download(new FoodExport, 'food_items.xlsx');
    }

    public function stats()
    {
        $totalRestaurants = Restaurant::totalRestaurants();
        $averageOpeningHours = Food::averageCalories();
        $totalFoodItems = Food::totalFoodItems();
        $averageCalories = Food::averageCalories();

        $allFoods = Food::orderBy('calories', 'desc')->get(['name', 'calories']);

        return view('admin.list_food.statistics', compact('totalRestaurants', 'averageOpeningHours', 'totalFoodItems', 'averageCalories', 'allFoods'));
    }

    public function customerhome()
    {
        $food = Food::with('restaurant')->distinct('name')->take(6)->get();
        return view('customer.dashboard', compact('food'));
    }
}
