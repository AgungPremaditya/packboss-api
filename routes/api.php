<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//AUTH ROUTES
Route::group(['prefix' => 'auth', 'namespace' => 'API'], function() {
    Route::post('login', 'AuthController@Login')->name('auth.login');
    Route::post('register', 'AuthController@Register')->name('auth.register');
    Route::get('unauthorized', 'AuthController@Unauthorized')->name('auth.unauthorized');
});

Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'API'], function(){

    //Packages Route
    Route::group(['prefix' => 'package', 'namespace' => 'Package'], function(){
       
        //Destination
        Route::resource('destination', 'DestinationController')->except('index', 'create', 'edit');
        
        //Origin
        Route::resource('origin', 'OriginController')->except('index', 'create', 'edit');
       
       //Category Packages
        Route::resource('category', 'CategoryController')->except('create', 'edit');

        //Packages
        Route::get('/', 'PackagesController@index')->name('packages.index'); // Index
        Route::post('/', 'PackagesController@store')->name('packages.store'); // Store
        Route::get('/{id}', 'PackagesController@show')->name('packages.show'); // Show
        Route::put('/{id}', 'PackagesController@update')->name('packages.update'); // Update
        Route::delete('/{id}', 'PackagesController@destroy')->name('packages.delete'); // Delete
        
    });

    Route::group(['prefix' => 'transaction'], function () {
        //Transaction
        Route::get('/', 'TransactionController@index')->name('packages.index'); // Index
        Route::post('/', 'TransactionController@store')->name('packages.store'); // Store
        Route::get('/{id}', 'TransactionController@show')->name('packages.show'); // Show
        Route::delete('/{id}', 'TransactionController@destroy')->name('packages.delete'); // Delete
    });
    
    
    Route::get('test', function () {
        if (Gate::allows('isAdmin')) {
            return(['messages' => 'anata ga suki dayo']);
        } else {
            return('403');
        }
    });
});
