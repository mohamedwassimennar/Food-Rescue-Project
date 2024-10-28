<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stocks ;
use App\Models\Categories ;
use App\Exports\StocksExport;
use Maatwebsite\Excel\Facades\Excel;

class StocksController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Find the stock by ID
        $stocks = Stocks::all();
        return view('stockss.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('stockss.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'food' => 'required|regex:/^[A-Za-z].*/|max:255',
            'expiration_date' => 'required|date|after:today',
            'quantity' => 'required|integer|min:1',
            'location' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        Stocks::create($validatedData);
    
        return redirect()->route('stockss.index')->with('success', 'Stock created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stock = Stocks::findOrFail($id);
        return view('stockss.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stock = Stocks::findOrFail($id);
        $categories = Categories::all();
        return view('stockss.edit', compact('stock', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'food' => 'required|regex:/^[A-Za-z].*/|max:255',
            'expiration_date' => 'required|date|after:today',
            'quantity' => 'required|integer|min:1',
            'location' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Find the stock and update it
        $stock = Stocks::findOrFail($id);
        $stock->update($validatedData);
    
        // Redirect to the index page with a success message
        return redirect()->route('stockss.index')->with('success', 'Stock updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Find the stock and delete it
         $stock = Stocks::findOrFail($id);
         $stock->delete();
 
         // Redirect to the index page with a success message
         return redirect()->route('stockss.index')->with('success', 'Stock deleted successfully.');
    }

    public function export()
{
    return Excel::download(new StocksExport, 'stocks.xlsx');
}
}
