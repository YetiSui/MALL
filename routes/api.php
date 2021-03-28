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
    Route::get('order', 'RiderController@order');//骑手系统首页订单信息
    Route::post('tostore', 'RiderController@toStore');//确认到店
    Route::post('sendout', 'RiderController@sendOut');//确认送出
    Route::get('riderinfo', 'RiderController@riderInfo');//骑手系统我的界面个人信息
    Route::get('orderser', 'RiderController@orderSer');//骑手系统首页订单信息搜索
    Route::get('mess', 'RiderController@mess');//骑手系统消息预览
    Route::get('messdet', 'RiderController@messDet');//骑手系统消息对话框
    Route::post('infoupload', 'RiderController@infoUpload');//骑手系统上传个人信息
    Route::post('idenupload ', 'RiderController@idenUpload');//骑手系统上传身份认证
    Route::post('messout ', 'RiderController@messOut');//发送消息

});//-lzz

