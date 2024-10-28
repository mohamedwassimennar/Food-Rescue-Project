<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataCustomerController extends Controller
{
    public function index()
    {
        $data_customer = User::all();
        return view('data_customer.index', compact('data_customer'));
    }

    public function create()
    {
        return view('data_customer.create');
    }

    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->route('data_customer.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('data_customer.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('data_customer.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('data_customer.index')->with('success', 'User deleted successfully');
    }
}