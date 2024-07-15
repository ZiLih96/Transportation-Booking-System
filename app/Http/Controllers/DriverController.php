<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Trip;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class DriverController extends Controller
{
    public function driver_application()
    {
        return redirect('driver_application');
    }

    public function processDriverForm(Request $req)
    {
        // Validate the request data
        $validatedData = $req->validate([
            'profilePicture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icFront' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icBack' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'drivingLicenseFront' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'drivingLicenseBack' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:drivers_application,email',
            'phone' => 'required|string|max:20',
            'vehicleModel' => 'required|string|max:255',
            'vehiclePictures' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'workingExperience' => 'required|string',
            'age' => 'required|integer|min:18|max:100',
        ]);
        
        // Store the uploaded files
        $profilePicturePath = $req->file('profilePicture')->store('profile_pictures', 'public');
        $icFrontPath = $req->file('icFront')->store('ic_pictures', 'public');
        $icBackPath = $req->file('icBack')->store('ic_pictures', 'public');
        $drivingLicenseFrontPath = $req->file('drivingLicenseFront')->store('driving_license_pictures', 'public');
        $drivingLicenseBackPath = $req->file('drivingLicenseBack')->store('driving_license_pictures', 'public');
        $vehiclePicturePaths = $req->file('vehiclePictures')->store('vehicle_pictures', 'public');

        // Create a new driver record
        $driver = new Application();
        $driver->name = $validatedData['name'];
        $driver->email = $validatedData['email'];
        $driver->phone = $validatedData['phone'];
        $driver->profile_picture = $profilePicturePath;
        $driver->ic_front = $icFrontPath;
        $driver->ic_back = $icBackPath;
        $driver->driving_license_front = $drivingLicenseFrontPath;
        $driver->driving_license_back = $drivingLicenseBackPath;
        $driver->vehicle_model = $validatedData['vehicleModel'];
        $driver->vehicle_pictures = $vehiclePicturePaths;
        $driver->working_experience = $validatedData['workingExperience'];
        $driver->age = $validatedData['age'];
        $driver->save();
    
        // Redirect the user to a success page or return a success response
        return redirect()->route('requestPending')->with('success', 'Driver application submitted successfully.');
    }

    public function requestPending(){
        return redirect('requestPending');
    }

    public function showTrips()
    {
        // Get the ID of the currently authenticated driver
        $driverId = auth('driver')->id();
    
        // Fetch trips associated with the authenticated driver and paginate them
        $trips = Trip::where('driver_id', $driverId)->paginate(10);
        
        // Load the view and pass data
        return view('driver', ['trips' => $trips]);
    }

    public function acceptTrip(Request $request, $id)
    {
        // Find the trip by its ID
        $trip = Trip::find($id);
        
        // Update the status of the trip to 'Accepted'
        $trip->status = 'Accepted';
        $trip->save();

        // Perform any other actions needed
        
        // Redirect back to the driver page
        return redirect('/driver');
    }

    public function rejectTrip(Request $request, $id)
    {
        // Validate the reason input
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);
    
        // Find the trip by its ID
        $trip = Trip::find($id);
        
        // Update the status of the trip to 'Rejected'
        $trip->status = 'Rejected';
    
        // Save the reason for rejection
        $trip->rejection_reason = $request->input('reason');
    
        $trip->save();
    
        // Perform any other actions needed
        
        // Redirect back to the driver page
        return redirect('/driver');
    }

    public function completeTrip(Request $request, $id)
    {
        // Find the trip by its ID
        $trip = Trip::find($id);
        
        // Update the status of the trip to 'Accepted'
        $trip->status = 'Completed';
        $trip->save();

        // Perform any other actions needed
        
        // Redirect back to the driver page
        return redirect('/driver');
    }

    public function updateDriver(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
        ]);

        $latestTrip = Trip::latest()->first();
        $latestTrip->driver_id = Driver::find($validatedData['driver_id'])->id;
        $latestTrip->save();

        // Redirect back or return a response
        return redirect()->route('finish')->with('success', 'Driver updated successfully');
    }
}
