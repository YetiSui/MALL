<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    public $timestamps = true;
    protected $primaryKey = "order_id";
    protected $guarded = [];

    /**
     * 骑手系统首页订单信息
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id
     * $Rider_id 骑手编号
     * @return array
     */
    Public static function cm_order($Rider_id){
        try{
            $data=self::Join('store','order.Store_id','store.Store_id')
                ->Join('user','order.User_id','user.User_id')
                ->where('order.Rider_id',$Rider_id)
                ->select('order.Order_id','order.Address_position','store.Store_name','user.User_name')
                ->get();
            return $data;

        }catch (\Exception $e){
            logError('骑手系统首页订单信息获取错误',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 骑手系统首页确认到店
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Order_id
     * $Order_id 订单编号
     * @return array
     */
    Public static function cm_toStore($Order_id){
        try{
            $data=self::where('Order_id',$Order_id)
                    ->update(['Order_Audit'=>4]);
            return $data;
        }catch (\Exception $e){
            logError('骑手系统首页确认到店错误',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 骑手系统首页确认送出
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Order_id
     * $Order_id 订单编号
     * @return array
     */
    Public static function cm_sendOut($Order_id){
        try{
            $data=self::where('Order_id',$Order_id)
                ->update(['Order_Audit'=>5]);
            return $data;
        }catch (\Exception $e){
            logError('骑手系统首页确认送出错误',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 骑手系统首页订单信息搜索
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id  $input
     * $Rider_id 骑手编号
     * $input 输入信息
     * @return array
     */
    Public static function cm_orderSer($Rider_id,$input){
        try{
            $data=self::Join('store','order.Store_id','store.Store_id')
                ->Join('user','order.User_id','user.User_id')
                ->where('order.Rider_id',$Rider_id)
                ->where('order.Order_id','like','%'.$input.'%')
                ->orwhere('order.Address_position','like','%'.$input.'%')
                ->orwhere('store.Store_name','like','%'.$input.'%')
                ->orwhere('user.User_name','like','%'.$input.'%')
                ->select('order.Order_id','order.Address_position','store.Store_name','user.User_name')
                ->get();
            return $data;

        }catch (\Exception $e){
            logError('骑手系统首页订单信息获取错误',[$e->getMessage()]);
            return null;
        }
    }

}
