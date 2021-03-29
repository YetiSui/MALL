<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\idenUploadRequest;
use App\Http\Requests\infoUploadRequest;
use App\Http\Requests\orderRequest;
use App\Http\Requests\orderSerRequest;
use App\Http\Requests\toStoreRequest;
use App\Models\Chat2;
use App\Models\Chat3;
use App\Models\Order;
use App\Models\Rider;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /***
     *传入图片返回路径
     * @param $email $ce
     * @return int
     */
    function upload($pic)
    {
        $path = $pic->store('public');
        $re = str_replace('public/','storage/',$path);
        $res = "http://127.0.0.1:8000/$re";
        return $res;
    }

    /**
     * 骑手系统首页订单信息
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    Public function order(orderRequest $request){
        $Rider_id=$request->input('Rider_id');
        $data =Order::cm_order($Rider_id);
        return $data ?
            json_success('成功!', $data, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     * 骑手系统首页确认到店
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    Public function toStore(toStoreRequest $request){
        $Order_id=$request->input('Order_id');
        $data =Order::cm_toStore($Order_id);
        return $data ?
            json_success('成功!', $data, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     * 骑手系统首页确认送出
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    Public function sendOut(toStoreRequest $request){
        $Order_id=$request->input('Order_id');
        $data =Order::cm_sendOut($Order_id);
        return $data ?
            json_success('成功!', $data, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     * 骑手系统我的界面个人信息
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    Public function riderInfo(orderRequest $request){
        $Rider_id=$request->input('Rider_id');
        $data =Rider::cm_riderinfo($Rider_id);
        return $data ?
            json_success('成功!', $data, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     * 骑手系统首页订单信息搜索
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    Public function orderSer(orderSerRequest $request){
        $Rider_id=$request->input('Rider_id');
        $input=$request->input('input');
        $data =Order::cm_orderSer($Rider_id,$input);
        return $data ?
            json_success('成功!', $data, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     * 骑手系统上传个人信息
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    Public function infoUpload(infoUploadRequest $request){
        $path = $this->upload($request['Rider_photo']);
        $Rider_id=$request->input('Rider_id');
        $Rider_name=$request->input('Rider_name');
        $data =Rider::cm_infoUpload($Rider_id,$Rider_name,$path);
        return $data ?
            json_success('成功!', $data, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     * 骑手系统上传身份认证
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    Public function idenUpload(idenUploadRequest $request){
        $path = $this->upload($request['Id_photo']);
        $Rider_id=$request->input('Rider_id');
        $Rider_name=$request->input('Rider_name');
        $Id_number=$request->input('Id_number');
        $data =Rider::cm_idenUpload($Rider_id,$Rider_name,$path,$Id_number);
        return $data ?
            json_success('成功!', $data, 200) :
            json_fail('失败!', null, 100);
    }

    /**
     *消息预览
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    public function mess(Request $request){
        $Rider_id = $request['$Rider_id'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber==0){
            //骑手全部消息
            $res1 = Chat2::cm_showAllMessages($Rider_id);
            $res2 = Chat3::cm_showAllMessages($Rider_id);
            $res['res1']=$res1;
            $res['res2']=$res2;
            return $res?
                json_success('展示全部数据成功!',$res,200):
                json_fail('展示全部数据失败!',null,100);
        }elseif ($chatNumber==1){
            //骑手用户
            $res = Chat3::cm_showAllMessages($Rider_id);
            return $res?
                json_success('展示骑手用户数据成功!',$res,200):
                json_fail('展示骑手用户数据失败!',null,100);
        }elseif ($chatNumber==2){
            //骑手商家
            $res = Chat2::cm_showAllMessages($Rider_id);
            return $res?
                json_success('展示骑手商家数据成功!',$res,200):
                json_fail('展示骑手商家数据失败!',null,100);
        }

    }

    /**
     *消息对话框
     * @auther
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    public function messDet(Request $request){
        $Rider_id = $request['Rider_id'];
        $Id = $request['Id'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber==1){
            $res = Chat3::cm_showMessageDetails($Rider_id,$Id);
            return $res?
                json_success('买家消息详情成功!',$res,200):
                json_fail('买家消息详情失败!',null,100);
        }elseif ($chatNumber==2){
            $res = Chat2::cm_showMessageDetails($Rider_id,$Id);
            return $res?
                json_success('商家消息详情成功!',$res,200):
                json_fail('商家消息详情失败!',null,100);
        }
    }

    /**
     *发送消息
     * @auther
     * @author ChenMiao <github.com/Yidaaa-u>
     * @return json
     */
    public function  messOut(Request $request){
        $Rider_id = $request['Rider_id'];
        $Id = $request['Id'];
        $Chat_text = $request['Chat_text'];
        $chatNumber = $request['chatNumber'];
        if ($chatNumber == 1){
            $res = Chat3::cm_SendMessage($Rider_id,$Id,$Chat_text);
            return $res?
                json_success('给买家发送成功!',$res,200):
                json_fail('给买家发送失败!',null,100);
        }elseif ($chatNumber == 2){
            $res = Chat2::cm_SendMessage($Rider_id,$Id,$Chat_text);
            return $res?
                json_success('给卖家发送成功!',$res,200):
                json_fail('给卖家发送失败!',null,100);
        }

    }

}
