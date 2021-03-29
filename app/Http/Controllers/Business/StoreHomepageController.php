<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowHomepageController;
use App\Http\Requests\ShowHomepageRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreHomepageController extends Controller
{
    /**
     * 展示店铺首页
     * @auther ZhongChun <github.com/RobbEr929>
     * @param ShowHomepageRequest $request
     * @return json
     */
    public static function showHomepage(ShowHomepageRequest $request){
        $res = Store::zc_showhomepage($request['Store_id']);
        return $res?
            json_success('展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }
}
