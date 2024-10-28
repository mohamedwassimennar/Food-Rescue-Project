<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        // Fetch all associations from the database
        $associations = Association::all();

        // Pass the associations to the view
        return view('restaurant.dashboard', compact('associations'));
    }
}
