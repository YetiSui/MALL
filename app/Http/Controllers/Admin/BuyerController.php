<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageSearchRequest;
use Illuminate\Http\Request;
use App\Models\Store;
use Psy\Util\Str;

class BuyerController extends Controller
{
    /**
     * 获取美食商品店铺
     * @author DuJingWen <github.com/DJWKK>
     * @return \Illuminate\Http\JsonResponse
     */
    public function pageFood(){
        $store_id = Store::djw_getFood();
        $data = Store::djw_getPublic($store_id);
        return $data?
            json_success('获取美食商品店铺成功!',$data,200) :
            json_fail('获取美食商品店铺失败!',null,100);
    }

    /**
     * 获取超市便利商品店铺
     * @author DuJingWen <github.com/DJWKK>
     * @return \Illuminate\Http\JsonResponse
     */
    public function pageSuper(){
        $store_id = Store::djw_getSuper();
        $data = Store::djw_getPublic($store_id);
        return $data?
            json_success('获取超市便利商品店铺成功!',$data,200) :
            json_fail('获取超市便利商品店铺失败!',null,100);
    }

    /**
     * 获取药品商品店铺
     * @author DuJingWen <github.com/DJWKK>
     * @return \Illuminate\Http\JsonResponse
     */
    public function pageMedicine(){
        $store_id = Store::djw_getMedicine();
        $data = Store::djw_getPublic($store_id);
        return $data?
            json_success('获取药品商品店铺成功!',$data,200) :
            json_fail('获取药品商品店铺失败!',null,100);
    }

    /**
     * 获取甜品甜点商品店铺
     * @author DuJingWen <github.com/DJWKK>
     * @return \Illuminate\Http\JsonResponse
     */
    public function pageDessert(){
        $store_id = Store::djw_getDessert();
        $data = Store::djw_getPublic($store_id);
        return $data?
            json_success('获取甜品甜点商品店铺成功!',$data,200) :
            json_fail('获取甜品甜点商品店铺失败!',null,100);
    }

    /**
     * 获取水果商品店铺
     * @author DuJingWen <github.com/DJWKK>
     * @return \Illuminate\Http\JsonResponse
     */
    public function pageFruit(){
        $store_id = Store::djw_getFruit();
        $data = Store::djw_getPublic($store_id);
        return $data?
            json_success('获取水果商品店铺成功!',$data,200) :
            json_fail('获取水果商品店铺失败!',null,100);
    }


    /**
     * 获取商品页面搜索
     * @author DuJingWen <github.com/DJWKK>
     * @param PageSearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pageSearch(PageSearchRequest $request){
        $content = $request->get('content');
        $data = Store::djw_getSearch($content);
        return $data?
            json_success('搜索店铺名称成功!',$data,200) :
            json_fail('搜索店铺名称失败!',null,100);
    }
}
