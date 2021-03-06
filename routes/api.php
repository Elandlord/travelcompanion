<?php

use Illuminate\Http\Request;

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

Route::get('/user', function () {
    return Auth::user();
})->middleware('auth:api');

Route::resource('users', 'UsersController');
Route::resource('users.routes', 'RoutesController');
Route::resource('users.hotels', 'HotelsController');
Route::resource('routes.locations', 'LocationsController');


