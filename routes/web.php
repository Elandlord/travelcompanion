<?php

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

Route::get('/', "PagesController@homepage");

Route::get('gethotel/{location}', 'HotelApiController@getHotel');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('logout', 'PagesController@logout');
