<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'
], function ($router) {
  Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
  Route::post('register', 'App\Http\Controllers\AuthController@register')->name('register');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh')->name('refresh');
    Route::get('user', 'App\Http\Controllers\AuthController@getUser')->name('user');
});


Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::apiResource('meals', 'App\Http\Controllers\MealController');
    Route::apiResource('menus', 'App\Http\Controllers\MenuController');
    Route::apiResource('daily-menus', 'App\Http\Controllers\DailyMenuController');
});

Route::fallback(function() {
    return response()->json(['message' => 'Not Found.'], 404);
});
