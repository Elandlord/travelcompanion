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

Route::get('/', "PagesController@entryPointVue");

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/planner', 'PlannerController@homepage');
Route::get('logout', 'PagesController@logout');

Route::get('search-hotels', 'HotelsSearchController@index');
Route::get('weather', 'WeatherController@index');
Route::get('get-profile', 'ProfileController@show');

Route::get('user/authenticated', function() {
	return response()->json(Auth::user(), 200);
});

