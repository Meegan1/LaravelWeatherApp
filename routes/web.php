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

use Illuminate\Http\Request;

Route::get('/', 'WeatherController@index');

Route::get('/{day}', 'WeatherController@index')->where('day','(?i)Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday');
Route::get('/{city}', 'WeatherController@show_city');

Route::get('/{city}/{day}', 'WeatherController@show_city')->where('day', '(?i)Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday');

Route::post('/', function(Request $request) {
    return redirect('/'.$request->input('search'));
});