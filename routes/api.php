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
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('backgroundapplication', 'BackGroundController@backGroundApplication');
    Route::post('backgrounddetails', 'BackGroundController@bckGoundDtails');
    Route::post('backgroundnewstore', 'BackGroundController@backGroundNewstore');
    Route::post('storebusinessstatus', 'BusinessOrdersController@storeBusinessStatus');
    Route::post('orderall', 'BusinessOrdersController@orderAll');
    Route::post('storeallmessages', 'BackGroundController@storeAllMessages');
    Route::post('storemessagedetails', 'BackGroundController@storeMessageDetails');
    Route::post('storesendmessage', 'BackGroundController@storeSendMessage');
});//-wdz
Route::prefix('buyer')->namespace('Buyer')->group(function () {
    Route::post('buyerinformation', 'BuyerController@buyerInformation');
    Route::post('buyeraddress', 'BuyerController@buyerAddress');
    Route::post('buyerdefault', 'BuyerController@buyerDefault');
    Route::post('buyerdelete', 'BuyerController@buyerDelete');
    Route::post('buyeraddto', 'BuyerController@buyerAddto');
    Route::post('buyerallmessages', 'BuyerController@buyerAllMessages');
    Route::post('buyermessagedetails', 'BuyerController@buyerMessageDetails');
    Route::post('buyersendmessage', 'BuyerController@buyerSendMessage');
});//-wdz
