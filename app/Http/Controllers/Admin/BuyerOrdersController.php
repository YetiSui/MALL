<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderAllRequest;
use App\Http\Requests\Admin\OrderDetailsRequest;
use App\Http\Requests\Admin\OrderEvaluatedRequest;
use App\Http\Requests\Admin\OrderSearchRequest;
use App\Models\Address;
use App\Models\Commodity;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerOrdersController extends Controller
{
    //没有限制用户userid
    /**
     * 订单页面搜索
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderSearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderSearch(OrderSearchRequest $request){
        $number = $request->get('number');
        $digit =  strlen($number);
        if ($digit >= 11 ){
            $data = Order::djw_getOrder($number);
        }else{
            $User_id = Address::djw_getPhone($number);
            $Order_id = Order::djw_getOrderId($User_id);
            $Commodity_id = OrderItems::djw_getCommodityId($Order_id);
            $data = Commodity::djw_getCommodity($Commodity_id);
        }
        return $data?
            json_success('（根据手机号或者订单号）订单搜索成功!',$data,200) :
            json_fail('（根据手机号或者订单号）订单搜索失败!',null,100);

    }

    /**
     * 订单展示
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderAllRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderAll(OrderAllRequest $request){
        $user_id = $request->get('user_id');
        $data = Order::djw_getShow($user_id);
        return $data?
            json_success('全部订单展示成功!',$data,200) :
            json_fail('全部订单展示失败!',null,100);
    }


    /**
     * 选择待评价
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderAllRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderUnEvaluation(OrderAllRequest $request){
        $user_id = $request->get('user_id');
        $data = Order::djw_getUnEvaluate($user_id);
        return $data?
            json_success('未评价订单展示成功!',$data,200) :
            json_fail('未评价订单展示失败!',null,100);
    }

    /**
     * 详细订单展示
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderDetailsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderDetails(OrderDetailsRequest $request){
        $order_id = $request->get('order_id');
        $data = Order::djw_getDetails($order_id);
        return $data?
            json_success('订单详情展示成功!',$data,200) :
            json_fail('订单详情展示失败!',null,100);
    }

    /**
     * 致电骑手
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderAllRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderCallRider(OrderAllRequest $request){
        $user_id = $request->get('user_id');
        $data = User::djw_getPhone($user_id);
        return $data?
            json_success('查找手机号成功!',$data,200) :
            json_fail('查找手机号失败!',null,100);
    }


    //地址不唯一

    /**
     * 配送信息展示
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderAllRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderDeliveryt(OrderAllRequest $request){
        $user_id = $request->get('user_id');
        $data = User::djw_getAddress($user_id);
        return $data?
            json_success('获取收货地址成功!',$data,200) :
            json_fail('获取收货地址失败!',null,100);
    }


    /**
     * 配送状态展示
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderAllRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderStatus(OrderAllRequest $request){
        $user_id = $request->get('user_id');
        $data = Order::djw_getStatus($user_id);
        return $data?
            json_success('配送状态展示成功!',$data,200) :
            json_fail('配送状态展示失败!',null,100);
    }

    /**
     * 星级点评（回显）
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderAllRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderEvaluate(OrderAllRequest $request){
        $user_id = $request->get('user_id');
        $data = User::djw_getEvaluate($user_id);
        return $data?
            json_success('星级点评（回显）成功!',$data,200) :
            json_fail('星级点评（回显）失败!',null,100);
    }


    /**
     * 星级点评（提交）
     * @author DuJingWen <github.com/DJWKK>
     * @param OrderEvaluatedRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderEvaluated(OrderEvaluatedRequest $request){
        $user_id = $request->get('user_id');
        $order_star = $request->get('order_star');
        $rider_star = $request->get('rider_star');
        $data = User::djw_updateStatus($user_id,$order_star,$rider_star);
        return $data?
            json_success('星级点评成功!',$data,200) :
            json_fail('星级点评失败!',null,100);
    }

}
