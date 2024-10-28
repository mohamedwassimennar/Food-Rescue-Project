<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;


class CategoriesController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|regex:/^[A-Za-z].*/|max:255', 
            'description' => 'required|regex:/^[A-Za-z].{9,}/', 
        ]);

        Categories::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Categories::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Categories::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|regex:/^[A-Za-z].*/|max:255', 
            'description' => 'required|regex:/^[A-Za-z].{9,}/', 
        ]);

        $category = Categories::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the category and delete it
        $category = Categories::findOrFail($id);
        $category->delete();

        // Redirect to the index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
