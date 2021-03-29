<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuditRidersRequest;
use App\Http\Requests\AuditStoreRequest;
use App\Http\Requests\ShowRidersRequest;
use App\Models\Rider;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Requests\ShowStoreRequest;


class BackstageController extends Controller
{
    /**
     * 展示所有店铺
     * @auther ZhongChun <github.com/RobbEr929>
     * @param ShowStoreRequest $request
     * @return json
     */
    public static function showStore(ShowStoreRequest $request){
        $res = Store::zc_show($request['indexOf']);
        return $res?
            json_success('展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }

    /**
     * 审核店铺
     * @auther ZhongChun <github.com/RobbEr929>
     * @param AuditStoreRequest $request
     * @return json
     */
    public static function auditStore(AuditStoreRequest $request){
        $res = Store::zc_audit($request['Store_id'],$request['Store_Audit'],$request['operation']);
        return $res?
            json_success('审核成功!',null,200):
            json_fail('审核失败!',null,100);
    }

    /**
     * 展示所有骑手
     * @auther ZhongChun <github.com/RobbEr929>
     * @param ShowStoreRequest $request
     * @return json
     */
    public static function showRiders(ShowRidersRequest $request){
        $res = Rider::zc_show($request['indexOf']);
        return $res?
            json_success('展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }

    /**
     * 审核骑手
     * @auther ZhongChun <github.com/RobbEr929>
     * @param AuditStoreRequest $request
     * @return json
     */
    public static function auditRiders(AuditRidersRequest $request){
        $res = Rider::zc_audit($request['Rider_id'],$request['Rider_Audit'],$request['operation']);
        return $res?
            json_success('审核成功!',null,200):
            json_fail('审核失败!',null,100);
    }
}
