<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Chat1;
use App\Models\Chat2;
use App\Models\Chat3;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     *个人信息展示
     * @auther wangdehzi
     * @param showRequest $request
     * @return json
     */
    public function buyerInformation(Request $request){
        $userId = $request['userId'];
        $res = User::wdz_show($userId);
        return $res?
            json_success('个人信息展示成功',$res,200):
            json_fail('个人信息展示失败!',null,100);
    }

    /**
     *展示所有地址
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public function buyerAddress(Request $request){
        $userId = $request['userId'];
        $res = Address::wdz_show($userId);
        return $res?
            json_success('地址展示成功',$res,200):
            json_fail('地址展示失败!',null,100);
    }

    /**
     *设置默认地址
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public function buyerDefault(Request $request){
        $addressId = $request['addressId'];
        $res = Address::wdz_showDefault($addressId);
        return $res?
            json_success('地址默认成功',$res,200):
            json_fail('地址默认失败!',null,100);
    }

    /**
     *删除地址
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public function buyerDelete(Request $request){
        $addressId = $request['Address_id'];
        $res = Address::wdz_showDelete($addressId);
        return $res?
            json_success('删除成功',$res,200):
            json_fail('删除地址失败!',null,100);
    }

    /**
     *添加地址
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public function buyerAddto(Request $request){
        $userId = $request['userId'];
        $addressName = $request['addressName'];
        $addressGender = $request['addressGender'];
        $addressNumber = $request['addressNumber'];
        $addressPosition = $request['addressPosition'];
        $res = Address::wdz_showAddto($userId,$addressName,$addressGender,$addressNumber,$addressPosition);
        return $res?
            json_success('添加成功',$res,200):
            json_fail('添加地址失败!',null,100);


    }

    /**
     *买家所有消息
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public function buyerAllMessages(Request $request){
        $userId = $request['userId'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber==0){
            //买家全部消息
            $res1 = Chat1::wdz_showbAllMessages($userId);
            $res2 = Chat3::wdz_showbAllMessages($userId);
            $res['res1']=$res1;
            $res['res2']=$res2;
            return $res?
                json_success('展示成功数据成功!',$res,200):
                json_fail('展示失败数据失败!',null,100);
        }elseif ($chatNumber==1){
            //商家买家
            $res = Chat1::wdz_showbAllMessages($userId);
            return $res?
                json_success('展示成功数据成功!',$res,200):
                json_fail('展示失败数据失败!',null,100);
        }elseif ($chatNumber==2){
            //买家骑手
            $res = Chat3::wdz_showbAllMessages($userId);
            return $res?
                json_success('展示成功数据成功!',$res,200):
                json_fail('展示失败数据失败!',null,100);
        }
    }


    /**
     *聊天详情
     * @auther
     * @param xxxRequest $request
     * @return json
     */
    public function buyerMessageDetails(Request $request){
        $userId = $request['userId'];
        $businessIdOrRiderId = $request['businessIdOrRiderId'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber==1){
            $res = Chat1::wdz_showMessageDetails($businessIdOrRiderId,$userId);
            return $res?
                json_success('消息详情成功成功!',$res,200):
                json_fail('消息详情成功失败!',null,100);
        }elseif ($chatNumber==2){
            $res = Chat3::wdz_showMessageDetails($userId,$businessIdOrRiderId);
            return $res?
                json_success('消息详情成功成功!',$res,200):
                json_fail('消息详情成功失败!',null,100);
        }
    }




    /**
     *用户发送消息
     * @auther wangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public function  buyerSendMessage(Request $request){
        $userId = $request['userId'];
        $businessIdOrRiderId = $request['businessIdOrRiderId'];
        $chatText = $request['chatText'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber == 1){
            $res = Chat1::wdz_SendMessage($businessIdOrRiderId,$userId,$chatText);
            return $res?
                json_success('发送成功!',$res,200):
                json_fail('发送失败!',null,100);
        }elseif ($chatNumber == 2){
            $res = Chat3::wdz_SendMessage($businessIdOrRiderId,$userId,$chatText);
            return $res?
                json_success('发送成功!',$res,200):
                json_fail('发送失败!',null,100);
        }

    }



}
