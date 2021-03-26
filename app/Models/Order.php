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
     * @author DuJingWen <github.com/DJWKK>
     * @param $number
     * @return |null
     */
    public static function djw_getOrder($number){
        try{
            $data = self::Join('commodity','order.Store_id','commodity.Store_id')
                ->Join('store','order.Store_id','store.Store_id')
                ->where('order.Order_id','like','%'.$number.'%')
                ->select('order.Store_id','commodity.Commodity_name','commodity.Commodity_photo','store.Store_Avatar','order.Order_evaluation','order.Order_Audit')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('查找失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @param $User_id
     * @return |null
     * 找Order——id
     */
    public static function djw_getOrderId($User_id){
        try{
            $data = self::where('User_id','=',$User_id)
                ->select('Order_id')
                ->get();
            return $data[0]['Order_id'];
        }catch(\Exception $e){
            logError('Order_id查找失败。',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $Store_id
     * @return |null
     */
    public static function getOrder2($Store_id){
        try{
            $data = self::Join('commodity','order.Store_id','commodity.Store_id')
                ->Join('store','order.Store_id','store.Store_id')
                ->where('order.Order_id','like','%'.$Store_id.'%')
                ->select('order.Store_id','commodity.Commodity_name','commodity.Commodity_photo','store.Store_Avatar','order.Order_evaluation','order.Order_Audit')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('查找失败',[$e->getMessage()]);
            return null;
        }
    }


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $User_id
     * @return |null
     */
    public static function djw_getShow($User_id){
        try{
            $data = self::Join('order_items','order.Order_id','order_items.Order_id')
                ->Join('commodity','order_items.Commodity_id','commodity.Commodity_id')
                ->Join('store','commodity.Store_id','store.Store_id')
                ->where('order.User_id',$User_id)
                ->select('order.Order_id','order.Store_id','store.Store_name','commodity.Commodity_name','commodity.Commodity_photo','store.Store_Avatar','order.Order_evaluation','order.Order_Audit')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('查找失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $User_id
     * @return |null
     */
    public static function djw_getUnEvaluate($User_id){
        try{
            $data = self::Join('order_items','order.Order_id','order_items.Order_id')
                ->Join('commodity','order_items.Commodity_id','commodity.Commodity_id')
                ->Join('store','commodity.Store_id','store.Store_id')
                ->where('order.User_id',$User_id)
                ->where('order.Order_evaluation',0)
                ->select('order.Order_id','order.Store_id','store.Store_name','commodity.Commodity_name','commodity.Commodity_photo','store.Store_Avatar','order.Order_evaluation','order.Order_Audit')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('查找失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $order_id
     * @return |null
     */
    public static function djw_getDetails($order_id){
        try{
            $data = self::Join('order_items','order.Order_id','order_items.Order_id')
                ->Join('commodity','order_items.Commodity_id','commodity.Commodity_id')
                ->Join('store','commodity.Store_id','store.Store_id')
                ->where('order.Order_id',$order_id)
                ->select('order.Order_id','commodity.Commodity_name','commodity.Commodity_photo','order.Order_evaluation','order.Order_Audit','order.Order_Audit_time1')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('查找某个详细页面失败',[$e->getMessage()]);
            return null;
        }
    }


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $user_id
     * @return |null
     */
    public static function djw_getStatus($user_id){
        try{
            $data = self::where('User_id','=',$user_id)
                ->select('Order_Audit_time1','Order_Audit_time2','Order_Audit_time3','Order_Audit_time4')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('配送状态查找失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $user_id
     * @param $order_items_Amount
     * @param $store_id
     * @param $Order_Audit_time1
     * @param $address_id
     * @return |null
     */
    public static function djw_addOrder2($user_id,$order_items_Amount,$store_id,$Order_Audit_time1,$address_id){
        try{
            $data = self::create([
                    'User_id'=>$user_id,
                    'Store_id'=>$store_id,
                    'Order_Audit'=>1,
                    'Address_id'=>$address_id,
                    'Order_Audit_time1'=>$Order_Audit_time1,
                    'Orderf_Amount'=>$order_items_Amount
                ]);
            return $data;
        }catch(\Exception $e){
            logError('订单提交成功',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $user_id
     * @param $order_items_Amount
     * @param $store_id
     * @param $address_id
     * @return |null
     */
    public static function djw_test($user_id,$order_items_Amount,$store_id,$address_id){
        try{
            $data = self::create([
                'User_id'=>$user_id,
                'Store_id'=>$store_id,
                'Order_Audit'=>1,
                'Address_id'=>$address_id,
                'Orderf_Amount'=>$order_items_Amount
            ]);
            return $data;
        }catch(\Exception $e){
            logError('订单提交成功',[$e->getMessage()]);
            return null;
        }
    }
}
