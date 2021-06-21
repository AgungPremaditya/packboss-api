<?php

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
    
    Route::group(['middleware' => 'auth.web'], function () {
        //Home
        Route::get('/home', 'HomeController@index')->name('home');
    
        //Pickup
        Route::get('/pickup/{receipt_number}', 'PickupController@create')->name('pickup.create');
        Route::post('/pickup/store', 'PickupController@store')->name('pickup.store');
        Route::get('/on-waiting', 'PickupController@onWaiting')->name('pickup.onwaiting');
    
        //Tracking
        Route::get('/tracking/create/{receipt_number}', 'TrackingController@create')->name('tracking.create');
        Route::post('/tracking/store', 'TrackingController@store')->name('tracking.store');
        Route::get('/tracking/{receipt_number}', 'TrackingController@index')->name('tracking.index');
    
        //Transaction
        Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
    });
});