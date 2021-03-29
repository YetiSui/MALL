<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCuponRequest;
use App\Http\Requests\NewCuponRequest;
use App\Http\Requests\ShowCuponRequest;
use App\Models\Coupons;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * 展示优惠券
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  ShowCuponRequest $request
     * @return json
     */
    public static function showCupon(ShowCuponRequest $request){
        $res = Coupons::zc_show($request['Store_id']);
        return $res?
            json_success('展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }

    /**
     * 添加优惠券
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  NewCuponRequest $request
     * @return json
     */
    public static function newCupon(NewCuponRequest $request){

        $res = Coupons::zc_new($request['Store_id'] ,$request['Coupons_Meet'],$request['Coupons_Reducing']);
        return $res?
            json_success('添加成功!',null,200):
            json_fail('添加失败!',null,100);
    }

    /**
     * 删除优惠券
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  DeleteCuponRequest $request
     * @return json
     */
    public static function deleteCupon(DeleteCuponRequest $request){

        $res = Coupons::zc_delete($request['Coupons_id']);
        return $res?
            json_success('删除成功!',null,200):
            json_fail('删除失败!',null,100);
    }
}
