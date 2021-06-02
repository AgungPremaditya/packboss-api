<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('unauthorized', 'AuthController@Unauthorized')->name('auth.unauthorized');
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::group(['prefix' => 'package', 'namespace' => 'Package'], function(){
        Route::resource('destination', 'DestinationController')->except('index', 'create', 'edit');
    });
    
    Route::get('test', function () {
        return(['messages' => 'anata ga suki dayo']);
    });
});
