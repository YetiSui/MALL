<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DetailsAccountRequest;
use App\Http\Requests\Admin\DetailsAddRequest;
use App\Http\Requests\Admin\DetailsGoodsRequest;
use App\Http\Requests\Admin\DetailsMessageRequest;
use App\Http\Requests\Admin\DetailsTitleRequest;
use App\Http\Requests\Admin\PageSearchRequest;
use App\Http\Requests\Admin\TestRequest;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\Store;

class BuyerDetailsController extends Controller
{

    /**
     * 商家店铺详情
     * @author DuJingWen <github.com/DJWKK>
     * @param DetailsTitleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailsTitle(DetailsTitleRequest $request){
        $store_id = $request->get('store_id');
        $data = Store::djw_getTitle($store_id);
        return $data?
            json_success('商家店铺header展示成功!',$data,200) :
            json_fail('商家店铺header展示失败!',null,100);
    }

    /**
     * 商家左侧分类
     * @author DuJingWen <github.com/DJWKK>
     * @param DetailsTitleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailsMenus(DetailsTitleRequest $request){
        $store_id = $request->get('store_id');
        $data = Commodity::djw_getMenus($store_id);
        return $data?
            json_success('商家左侧分类展示成功!',$data,200) :
            json_fail('商家左侧分类展示失败!',null,100);
    }


    /**
     * 商家右侧商品详情
     * @author DuJingWen <github.com/DJWKK>
     * @param DetailsGoodsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailsGoods(DetailsGoodsRequest $request){
        $classification_id = $request->get('classification_id');
        $data = Commodity::djw_getGoods($classification_id);
        return $data?
            json_success('商家右侧商品展示成功!',$data,200) :
            json_fail('商家右侧商品展示失败!',null,100);
    }

    /**
     * 搜索商品
     * @author DuJingWen <github.com/DJWKK>
     * @param PageSearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailsSearch(PageSearchRequest $request){
        $content = $request->get('content');
        $data = Commodity::djw_getContent($content);
        return $data?
            json_success('搜索展示成功!',$data,200) :
            json_fail('搜索展示失败!',null,100);
    }

    /**
     * 显示收货地址
     * @author DuJingWen <github.com/DJWKK>
     * @param DetailsMessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailsMessage(DetailsMessageRequest $request){
        $user_id = $request->get('user_id');
        $data = User::djw_getAddress($user_id);
        return $data?
            json_success('查找地址成功!',$data,200) :
            json_fail('查找地址失败!',null,100);
    }

    /**
     * 购物车展示
     * @author DuJingWen <github.com/DJWKK>
     * @param DetailsAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailsAdd(DetailsAddRequest $request){
        $commodity_id = $request->get('commodity_id');
        $data = Commodity::djw_getShop($commodity_id);
        return $data?
            json_success('购物车展示成功!',$data,200) :
            json_fail('购物车展示失败!',null,100);
    }


    /**
     * 提交订单
     * @author DuJingWen <github.com/DJWKK>
     * @param DetailsAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailsAccount(DetailsAccountRequest $request){
        $order_items_Amount = $request->get('order_items_Amount');
        $store_id = $request->get('store_id');
        $commodity_id = $request->get('commodity_id');
        $order_items_number = $request->get('order_items_number');
        $user_id = $request->get('user_id');
        $address_id = $request->get('address_id');
        $Order_Audit_time1 = date('Y-m-d h:i:s', time());
        $data = Order::djw_addOrder2($user_id,$order_items_Amount,$store_id,$Order_Audit_time1,$address_id);
        $data = OrderItems::djw_addOrderItems($order_items_Amount,$commodity_id,$order_items_number);
        return $data?
            json_success('订单提交成功!',$data,200) :
            json_fail('订单提交失败!',null,100);
    }
}
