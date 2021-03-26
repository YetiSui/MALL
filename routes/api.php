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
    Route::post('lzztest', 'AdminLoginController@lzztest');
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

Route::prefix('/admin')->namespace('Admin')->group(function(){
    Route::get('/test','BuyerController@test');
    Route::get('/pagefood','BuyerController@pageFood');
    Route::get('/pagesuper','BuyerController@pageSuper');
    Route::get('/pagemedicine','BuyerController@pageMedicine');
    Route::get('/pagedessert','BuyerController@pageDessert');
    Route::get('/pagefruit','BuyerController@pageFruit');
    Route::post('/pagesearch','BuyerController@pageSearch');
    Route::post('/detailstitle','BuyerDetailsController@detailsTitle');
    Route::post('/detailsmenus','BuyerDetailsController@detailsMenus');
    Route::post('/detailsgoods','BuyerDetailsController@detailsGoods');
    Route::post('/detailssearch','BuyerDetailsController@detailsSearch');
    Route::post('/detailsmessage','BuyerDetailsController@detailsMessage');
    Route::post('/detailsadd','BuyerDetailsController@detailsAdd');
    Route::post('/detailsaccount','BuyerDetailsController@detailsAccount');
    Route::post('/ordersearch','BuyerOrdersController@orderSearch');
    Route::post('/orderall','BuyerOrdersController@orderAll');
    Route::post('/orderunevaluation','BuyerOrdersController@orderUnEvaluation');
    Route::post('/orderdetails','BuyerOrdersController@orderDetails');
    Route::post('/ordercallrider','BuyerOrdersController@orderCallRider');
    Route::post('/orderdeliveryt','BuyerOrdersController@orderDeliveryt');
    Route::post('/orderstatus','BuyerOrdersController@orderstatus');
    Route::post('/orderevaluate','BuyerOrdersController@orderEvaluate');
    Route::post('/orderevaluated','BuyerOrdersController@orderEvaluated');
});
