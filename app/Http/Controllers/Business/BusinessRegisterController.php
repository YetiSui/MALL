<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessRegisterController extends Controller
{
    /**
     * 商家注册
     * @auther ZhongChun <github.com/RobbEr929>
     * @param RegisterRequest $request
     * @return json
     */
    public static function register(RegisterRequest $request){
        $res = Business::zc_register($request['Business_number'],$request['Business_Password']);
        return $res?
            json_success('注册成功!',null,200):
            json_fail('注册失败!',null,100);
    }
}
