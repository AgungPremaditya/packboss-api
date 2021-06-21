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
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    });
    
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

        //Transport
        Route::get('/transport', 'TransportController@index')->name('transport.index');
        Route::get('/transport/create', 'TransportController@create')->name('transport.create');
        Route::post('/transport/store', 'TransportController@store')->name('transport.store');
        Route::get('/transport/edit/{id}', 'TransportController@edit')->name('transport.edit');
        Route::put('/transport/update/{id}', 'TransportController@update')->name('transport.update');
        Route::delete('/transport/delete/{id}', 'TransportController@destroy')->name('transport.delete');

        //Transport
        Route::get('/operator', 'OperatorController@index')->name('operator.index');
        Route::get('/operator/create', 'OperatorController@create')->name('operator.create');
        Route::post('/operator/store', 'OperatorController@store')->name('operator.store');
        Route::get('/operator/edit/{id}', 'OperatorController@edit')->name('operator.edit');
        Route::put('/operator/update/{id}', 'OperatorController@update')->name('operator.update');
        Route::put('/operator/delete/{id}', 'OperatorController@destroy')->name('operator.delete');
    });
});