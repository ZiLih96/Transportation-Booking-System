<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Driver;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationApproved;

class ApplicationController extends Controller
{
    function show()
    {
        $data = Application::all();
        $data = Application::paginate(10);
        return view('showapplication',['applications'=>$data]);
        //return DB::select("select * from users");
        //return User::all();
    }

    function deleteApplication($id)
    {
        $data=Application::find($id);
        $data->delete();
        return redirect('showapplication');
    }

    // function showUpdate($id)
    // {
    //     $data = Application::find($id);
    //     return view('updateUser', ['data'=>$data]);
    // }

    function approveApplication(Request $req, $id)
    {
        // Retrieve the application from the database by its ID
        $application = Application::find($id);
    
        // Create a new entry in the 'drivers' table with the application data
        Driver::create([
            'name' => $application->name,
            'email' => $application->email,
            'password' => 123456,
        ]);
    
        // Send an email notification to the user
        // Mail::to($application->email)->send(new ApplicationApproved($application));
    
        // Delete the application from the 'drivers_application' table
        $application->delete();
    
        return redirect('showapplication');
    }

    public function sendApprovalEmail(Application $application)
    {
        // Send email notification
        Mail::to($application->email)->send(new ApplicationApproved($application));
    }
}
