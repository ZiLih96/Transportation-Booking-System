<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\TripController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/driver', [LoginController::class,'showDriverLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/driver', [RegisterController::class,'showDriverRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/driver', [LoginController::class,'driverLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::post('/register/driver', [RegisterController::class,'createDriver']);

Route::group(['middleware' => 'auth:driver'], function () {
    Route::view('/driver', 'driver');
    Route::get('/driver', [DriverController::class, 'showTrips'])->name('driver');
    Route::get('/profit', [TripController::class, 'showCompleteTrips'])->name('completeTrips');
});

Route::group(['middleware' => 'auth:admin'], function () { 
    Route::get('/datatest', [UserController::class, 'testData'])->name('datatest');
    Route::get('/driverlist', [UserController::class, 'driverList'])->name('driverlist');
});
Route::get('/driver', [DriverController::class, 'showTrips'])->name('driver');

Route::get('logout', [LoginController::class,'logout']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Tranfered from fyp----------------------------------------------------------------------------------


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/trip', [DashboardController::class, 'trip'])->name('trip');

Route::get('/triphistory', [DashboardController::class, 'testData'])->name('triphistory');

Route::get('/chooseDriver', [DashboardController::class, 'chooseDriver'])->name('chooseDriver');
Route::post('/updateDriver', [DriverController::class, 'updateDriver'])->name('updateDriver');

Route::get('/finish', [DashboardController::class, 'finish'])->name('finish');
Route::post('/finish', [DashboardController::class, 'finish'])->name('finish');

Route::get('/showapplication', [ApplicationController::class, 'show'])->name('showapplication');

Route::get('/approveApplication/{id}', [ApplicationController::class, 'approveApplication'] )->name('approveApplication');

Route::get('/deleteApplication/{id}', [ApplicationController::class, 'deleteApplication'])->name('deleteApplication');

Route::view('/addUser', 'addUser')->name('addUser');
Route::post('/addUser', [UserController::class, 'addUser']);

Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);
Route::get('/deleteDriver/{id}', [UserController::class, 'deleteDriver']);

Route::get('/updateUser/{id}', [UserController::class, 'showUpdate'] );
Route::post('/updateUser/{id}', [UserController::class, 'approveApplication'] );

Route::view('/driver_application', [DriverController::class, 'driver_application'])->name('driver_application');
Route::post('/driver_application', [DriverController::class, 'processDriverForm'])->name('processDriverForm');

Route::view('/requestPending', [DriverController::class, 'requestPending'])->name('requestPending');

Route::get('/acceptTrip/{id}', [DriverController::class, 'acceptTrip'] )->name('acceptTrip');
Route::get('/rejectTrip/{id}', [DriverController::class, 'rejectTrip'])->name('rejectTrip');
Route::post('/rejectTrip/{id}', [DriverController::class, 'rejectTrip'])->name('rejectTrip');
Route::get('/completeTrip/{id}', [DriverController::class, 'completeTrip'] )->name('completeTrip');

Route::post('/giveRating/{trip_id}', [TripController::class, 'giveRating'])->name('giveRating');


