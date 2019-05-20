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

Route::get("horse-races", "HorseRaceController@getActiveRaces");
Route::post("horse-races", "HorseRaceController@createRace");
Route::post("horse-races/advance", "HorseRaceController@advanceActiveRaces");
Route::get("horse-races/results", "HorseRaceController@getBestResults");
