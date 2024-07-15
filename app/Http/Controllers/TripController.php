<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip; // Adjust the namespace as per your application
use Illuminate\Support\Facades\Auth; // Import Auth facade

class TripController extends Controller
{
    public function __construct()
    {
        // Apply the 'auth' middleware to all methods in this controller
        $this->middleware('auth');
    }

    public function index()
    {
        // Get the authenticated user's ID
        $userId = auth()->id();
        
        // Fetch only the trips associated with the authenticated user
        $trips = Trip::where('user_id', $userId)->paginate(10); // Assuming you want to paginate the results

        return view('trips.index', compact('trips'));
    }

    public function showCompleteTrips()
    {
        // Get the ID of the currently authenticated user under the 'driver' guard
        $userId = auth('driver')->id();
    
        // Fetch all trips with the "complete" status associated with the authenticated user
        $completeTrips = Trip::where('status', 'Completed')->where('driver_id', $userId)->get();
        
        // Calculate total price
        $totalPrice = $completeTrips->sum('money');
    
        // Load the view and pass data
        return view('profit', compact('completeTrips', 'totalPrice'));
    }

    public function giveRating(Request $request, $trip_id)
    {
        // Retrieve the trip by ID
        $trip = Trip::findOrFail($trip_id);
        
        // Perform validation on the rating input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // Example validation rules for rating (adjust as needed)
        ]);

        // Update the trip record with the provided rating
        $trip->rating = $request->rating;
        $trip->save();

        // Redirect back or to a specific page after giving the rating
        return redirect()->back()->with('success', 'Rating submitted successfully');
    }
}
