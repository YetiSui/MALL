<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreSetupController extends Controller
{
    /**
     * 修改门店设置
     * @auther ZhongChun <github.com/RobbEr929>
     * @param UpdateStoreRequest $request
     * @return json
     */
    public static function updateStore(UpdateStoreRequest $request){
        if(!$request->hasFile('Store_Avatar')){
            dd('文件不存在');
        }
        $img = $request->file('Store_Avatar');
        $path = $img->store('public/Store_Avatar'.date('Ymd'));
        $res = Store::zc_update($request['Store_id'],$request['Store_name'],$request['Store_Category'],$path,$request['Store_Business_status'],$request['Store_Notice'],$request['Store_number'],$request['Store_Address']);
        return $res?
            json_success('修改成功!',null,200):
            json_fail('修改失败!',null,100);


    }
}
