<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;

class UserController extends Controller
{
    function testData()
    {
        $data = User::paginate(10);
        return view('datatest',['users'=>$data]);
    }

    function driverList()
    {
        $data = Driver::paginate(10);
        return view('driverlist',['drivers'=>$data]);

    }

    public function addUser(Request $req)
    {
        $user=new User;
        $user->username=$req->username;
        $user->password=$req->password;
        $user->role=$req->role;
        $user->save();
        return redirect('addUser');
    }

    function deleteUser($id)
    {
        $data=User::find($id);
        $data->delete();
        return redirect('datatest');
    }   

    function deleteDriver($id)
    {
        $data=Driver::find($id);
        $data->delete();
        return redirect('driverlist');
    }

    // function showUpdate($id)
    // {
    //     $data=User::find($id);
    //     return view('updateUser', ['data'=>$data]);
    // }

    // function updateUser(Request $req)
    // {
    //     $data=User::find($req->id);
    //     $data->username=$req->username;
    //     $data->password=$req->password;
    //     $data->role=$req->role;
    //     $data->save();
    //     return redirect('datatest');
    // }
}
