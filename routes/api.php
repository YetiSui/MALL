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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::post('login', 'AdminLoginController@login');
    Route::post('logout', 'AdminLoginController@logout');
    Route::post('registered', 'AdminLoginController@registered');
});//-lzz
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('login', 'BusinessLoginController@login');
    Route::post('logout', 'BusinessLoginController@logout');
    Route::post('registered', 'BusinessLoginController@registered');
});//-lzz
Route::prefix('rider')->namespace('Rider')->group(function () {
    Route::post('login', 'RiderLoginController@login');
    Route::post('logout', 'RiderLoginController@logout');
    Route::post('registered', 'RiderLoginController@registered');
});//-lzz
