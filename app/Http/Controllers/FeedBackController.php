<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends Controller
{
    public function index()
    {
        // Get the current authenticated user's ID
        $id = Auth::user()->id;

        // Fetch feedbacks related to the restaurant, joining with the associations table
        $feedbacks = FeedBack::where('restaurant_id', $id)
            ->join('associations', 'associations.id', '=', 'feed_backs.association_id')
            ->select('feed_backs.*', 'associations.nom as association_nom')
            ->get();

        // Fetch the list of associations (for example, to display in the view)
        $associations = Association::all(); 

        // Pass both feedbacks and associations to the view
        return view('feedbacks.index', compact('feedbacks', 'associations'));
    }

    public function create()
    {
        // Fetch associations to allow selection when creating feedback
        $associations = Association::all(); 

        return view('feedbacks.create', compact('associations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'comments' => 'required|string',
            'association_id' => 'required|exists:associations,id', // Make sure the association is valid
        ]);

        // Create the feedback with the data from the request
        FeedBack::create([
            'note' => $request->note,
            'comments' => $request->comments,
            'association_id' => $request->association_id,
            'restaurant_id' => Auth::user()->id, // Assuming this relates to the logged-in restaurant
        ]);

        return redirect()->route('feedbacks.index')->with('success', 'Feedback created successfully.');
    }

    public function show(FeedBack $feedback)
    {
        return view('feedbacks.show', compact('feedback'));
    }

    public function edit(FeedBack $feedback)
    {
        // Fetch associations to allow reassignment when editing feedback
        $associations = Association::all();

        return view('feedbacks.edit', compact('feedback', 'associations'));
    }

    public function update(Request $request, FeedBack $feedback)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'comments' => 'required|string',
            'association_id' => 'required|exists:associations,id', // Ensure the association is valid
        ]);

        // Update the feedback with new data
        $feedback->update([
            'note' => $request->note,
            'comments' => $request->comments,
            'association_id' => $request->association_id,
        ]);

        return redirect()->route('feedbacks.index')->with('success', 'Feedback updated successfully.');
    }

    public function destroy(FeedBack $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
    }
    public function assosFeedback()
    {
        // Get the authenticated user's associated restaurant/association ID
        $associationId = Auth::user()->association_id; // Adjust this if necessary
        // Fetch feedbacks for the associated association
        $feedbacks = FeedBack::where('association_id', $associationId)
            ->with('association') // Ensure you load the association data if needed
            ->get();
            $feedbacks = Feedback::paginate(3);

    
        // Return the view with the feedbacks
        return view('feedbacks.assosfeedback', compact('feedbacks'));
    }
    
    

}
