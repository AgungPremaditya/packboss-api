<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Web'], function () {
    //Auth
    Route::get('/', 'AuthController@loginIndex')->name('login'); 
    Route::post('/', 'AuthController@login');
    Route::get('/unauthorized', 'AuthController@unauthorized')->name('unauthorized');
    Route::get('/forbidden', 'AuthController@forbidden')->name('forbidden');
    
    //Home
    Route::get('/home', 'HomeController@index')->name('home');

    //Pickup
    Route::get('/pickup/{receipt_number}', 'PickupController@create')->name('pickup.create');
    Route::post('/pickup/store', 'PickupController@store')->name('pickup.store');
    Route::get('/on-waiting', 'PickupController@onWaiting')->name('pickup.onwaiting');

    //Tracking
    Route::get('/tracking/create/{receipt_number}', 'TrackingController@create');
});