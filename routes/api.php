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
Route::group(['prefix' => 'auth'], function() {
    Route::post('login', 'AuthController@Login')->name('auth.login');
    Route::post('register', 'AuthController@Register')->name('auth.register');
    Route::get('unauthorized', 'AuthController@Unauthorized')->name('auth.unauthorized');
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::group(['prefix' => 'package', 'namespace' => 'Package'], function(){
        Route::resource('destination', 'DestinationController')->except('index', 'create', 'edit');
        Route::resource('origin', 'OriginController')->except('index', 'create', 'edit');
        Route::resource('category', 'CategoryController')->except('create', 'edit');
    });
    
    
    Route::get('test', function () {
        if (Gate::allows('isAdmin')) {
            return(['messages' => 'anata ga suki dayo']);
        } else {
            return('403');
        }
    });
});
