<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Chat1;
use App\Models\Chat2;
use App\Models\Store;
use Illuminate\Http\Request;

class BackGroundController extends Controller
{
    /**
     *查询申请记录
     * @auther wangdehzi
     * @param showRequest $request
     * @return json
     */
    //查询申请记录
    public function backGroundApplication(Request $request){
        $storeAudit = $request['storeAudit'];
        $res = Store::wdz_show($storeAudit);
        return $res?
            json_success('表单展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }
    /**
     *申请记录详情
     * @auther wangdehzi
     * @param showRequest $request
     * @return json
     */
    Public function bckGoundDtails(Request $request){
        $storeId = $request['storeId'];
        $res = Store::wdz_showDetails($storeId);
        return $res?
            json_success('详情展示成功!',$res,200):
            json_fail('详情展示展示失败!',null,100);
    }
    /**
     *新建店铺
     * @auther wangdehzi
     * @param showRequest $request
     * @return json
     */
    public function backGroundNewstore(Request $request){
        $businessId = $request['businessId'];
        $storeName = $request['storeName'];
        $stroreContact = $request['stroreContact'];
        $storeNumber = $request['storeNumber'];
        $storeCategory = $request['storeCategory'];
        $idPhoto = $request['idPhoto'];
        $storeLicense = $request['storeLicense'];
        $storeDocuments = $request['storeDocuments'];
        $storePhoto = $request['storePhoto'];
        $res = Store::wdz_newstore($businessId,$storeName,$stroreContact,$storeNumber,$storeCategory,$idPhoto,$storeLicense,$storeDocuments,$storePhoto);
        return $res?
            json_success('插入数据成功!',$res,200):
            json_fail('插入数据失败!',null,100);
    }
    /**
     *聊天展示
     * @auther wangdehzi
     * @param showRequest $request
     * @return json
     */
    public function storeAllMessages(Request $request){
        $businessId = $request['businessId'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber==0){
            //商家全部消息
            $res1 = Chat1::wdz_showAllMessages($businessId);
            $res2 = Chat2::wdz_showAllMessages($businessId);
            $res['res1']=$res1;
            $res['res2']=$res2;
            return $res?
                json_success('展示成功数据成功!',$res,200):
                json_fail('展示失败数据失败!',null,100);
        }elseif ($chatNumber==1){
            //商家用户
            $res = Chat1::wdz_showAllMessages($businessId);
            return $res?
                json_success('展示成功数据成功!',$res,200):
                json_fail('展示失败数据失败!',null,100);
        }elseif ($chatNumber==2){
            //商家骑手
            $res = Chat2::wdz_showAllMessages($businessId);
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
    public function storeMessageDetails(Request $request){
        $businessId = $request['businessId'];
        $userIdOrRiderId = $request['userIdOrRiderId'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber==1){
            $res = Chat1::wdz_showMessageDetails($businessId,$userIdOrRiderId);
            return $res?
                json_success('消息详情成功成功!',$res,200):
                json_fail('消息详情成功失败!',null,100);
        }elseif ($chatNumber==2){
            $res = Chat2::wdz_showMessageDetails($businessId,$userIdOrRiderId);
            return $res?
                json_success('消息详情成功成功!',$res,200):
                json_fail('消息详情成功失败!',null,100);
        }
    }

    /**
     *发送消息
     * @auther wangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public function  storeSendMessage(Request $request){
        $businessId = $request['businessId'];
        $userIdOrRiderId = $request['userIdOrRiderId'];
        $chatText = $request['chatText'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber == 1){
            $res = Chat1::wdz_SendMessage($businessId,$userIdOrRiderId,$chatText);
            return $res?
                json_success('发送成功!',$res,200):
                json_fail('发送失败!',null,100);
        }elseif ($chatNumber == 2){
            $res = Chat2::wdz_SendMessage($businessId,$userIdOrRiderId,$chatText);
            return $res?
                json_success('发送成功!',$res,200):
                json_fail('发送失败!',null,100);
        }

    }
}
