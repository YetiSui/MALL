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

});

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

Route::prefix('backstage')->namespace('Admin')->group(function () {
    Route::get('showstore', 'BackstageController@showStore');//展示所有店铺
    Route::post('auditstore', 'BackstageController@auditStore');//审核店铺
    Route::get('showriders', 'BackstageController@showRiders');//展示所有棋手
    Route::post('auditriders', 'BackstageController@auditRiders');//审核骑手
});//@auther ZhongChun

Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('register', 'BusinessRegisterController@register');//商家注册
    Route::get('showhomepage', 'StoreHomepageController@showHomepage');//展示店铺首页
    Route::post('updatestore', 'StoreSetupController@updateStore');//修改门店设置
    Route::get('showallgoods', 'GoodsManageController@showAllGoods');//展示所有商品
    Route::get('showallclassify', 'GoodsManageController@showAllClassify');//展示所有分类
    Route::get('findgoods', 'GoodsManageController@findGoods');//回显指定商品
    Route::post('newgoods', 'GoodsManageController@newGoods');//添加商品
    Route::post('newclassify', 'GoodsManageController@newClassify');//添加分类
    Route::post('updatestock', 'GoodsManageController@updateStock');//修改库存价格
    Route::post('updatestatus', 'GoodsManageController@updateStatus');//下架商品
    Route::post('updategoods', 'GoodsManageController@updateGoods');//修改商品名照片
    Route::post('deleteclassify', 'GoodsManageController@deleteClassify');//删除分类
    Route::get('showcupon', 'ActivityController@showCupon');//展示优惠券
    Route::post('newcupon', 'ActivityController@newCupon');//添加优惠券
    Route::post('deletecupon', 'ActivityController@deleteCupon');//删除优惠券
});//@auther ZhongChun




