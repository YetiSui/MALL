<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;

class BusinessOrdersController extends Controller
{
    /**
     *商家订单管理页面
     * @auther wangdehzi
     * @param showRequest $request
     * @return json
     */
    public function storeBusinessStatus(Request $request){
        $storeId = $request['storeId'];
        $res = Store::wdz_showstate($storeId);
        return $res?
            json_success('营业状态展示成功',$res,200):
            json_fail('营业状态展示失败!',null,100);
    }
    /**
     *商家订单展示页面
     * @auther wangdehzi
     * @param showRequest $request
     * @return json
     */
    public function orderAll(Request $request){
        $storeId = $request['storeId'];
        $orderAudit = $request['orderAudit'];
        $res = Order::wdz_showOrder($storeId,$orderAudit);
        return $res?
            json_success('店铺订单展示成功',$res,200):
            json_fail('店铺订单展示失败!',null,100);
    }
}
