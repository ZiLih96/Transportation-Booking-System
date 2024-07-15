<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function trip()
    {
        return view('trip');
    }

    // public function oneWayTrip(Request $request)
    // {
    //     $startpoint = $request->input('startpoint');
    //     $destination = $request->input('destination');
    //     return view('oneWayTrip', ['startpoint' => $startpoint],['destination' => $destination]);
    // }
    
    // public function scheduledTrip(Request $request)
    // {
    //     $startpoint = $request->input('startpoint');
    //     $destination = $request->input('destination');
    //     return view('scheduledTrip', ['startpoint' => $startpoint],['destination' => $destination]);
    // }

    function testData()
    {
        //$data = User::all();
        $data = Trip::paginate(10);
        return view('triphistory',['trips'=>$data]);
        //return DB::select("select * from users");
        //return User::all();
    }

    public function chooseDriver(Request $request)
    {
        $trip = new Trip();
        $trip->user_id = Auth::id();
        $trip->startpoint = $request->input('startpoint');
        $trip->destination = $request->input('destination');
        $trip->money = $request->input('money');
        
        // Extract start and end dates from date range and convert format
        $dateRange = $request->input('dateRange');
        list($startDate, $endDate) = explode(" - ", $dateRange);
        $trip->start_date = date('Y-m-d', strtotime($startDate));
        $trip->end_date = date('Y-m-d', strtotime($endDate));
        
        $trip->pickup_time = $request->input('pickup_time');
        $trip->return_time = $request->input('return_time');

        $trip->requirement = $request->input('requirement');
    
        $trip->save();
    
        return view('chooseDriver');
    }

    public function finish(Request $request)
    {
        // Find the latest trip data
        $latestTrip = Trip::orderBy('id', 'desc')->first();
    
        if ($latestTrip) {
            // Get the concatenated driver's ID and name from the form
            $driverInfo = $request->input('driver_info');
    
            // Separate the ID and name using the delimiter (comma in this case)
            list($driverId, $driverName) = explode(',', $driverInfo);
    
            // Update the latest trip with the driver's ID and name
            $latestTrip->driver_id = $driverId;
            $latestTrip->driver_name = $driverName;
            $latestTrip->save();
    
            return view('finish');
        } else {
            // Handle the case where there are no trips
            // For example, you can redirect back with an error message
            return redirect()->back()->with('error', 'No trips found.');
        }
    }    
}
