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
     *
     * @autherwangdezhi
     * @param showRequest $request
     * @return json
     */
    public static function wdz_showOrder($storeId,$orderAudit){
        try{
            if ($orderAudit == 0){
                $res = self::Join('order_items','order.Order_id','order_items.Order_id')
                    ->Join('commodity','order_items.Commodity_id','commodity.Commodity_id')
                    ->Join('store','commodity.Store_id','store.Store_id')
                    ->where('order.User_id',$storeId)
                    ->select('order.Order_id','order.Store_id','store.Store_name','commodity.Commodity_name','commodity.Commodity_photo','store.Store_Avatar','order.Order_Audit')
                    ->get();
                return $res ?
                    $res :
                    false;
            }elseif ($orderAudit == 1){
                $res = self::Join('order_items','order.Order_id','order_items.Order_id')
                    ->Join('commodity','order_items.Commodity_id','commodity.Commodity_id')
                    ->Join('store','commodity.Store_id','store.Store_id')
                    ->where('order.User_id',$storeId)
                    ->where('Order_Audit','=',1)
                    ->select('order.Order_id','order.Store_id','store.Store_name','commodity.Commodity_name','commodity.Commodity_photo','store.Store_Avatar','order.Order_evaluation','order.Order_Audit')
                    ->get();
                return $res ?
                    $res :
                    false;
            }elseif ($orderAudit == 1) {
                $res = self::Join('order_items','order.Order_id','order_items.Order_id')
                    ->Join('commodity','order_items.Commodity_id','commodity.Commodity_id')
                    ->Join('store','commodity.Store_id','store.Store_id')
                    ->where('order.User_id',$storeId)
                    ->where('Order_Audit','=',2)
                    ->select('order.Order_id','order.Store_id','store.Store_name','commodity.Commodity_name','commodity.Commodity_photo','store.Store_Avatar','order.Order_Audit')
                    ->get();
                return $res ?
                    $res :
                    false;
            }
        }catch (\Exception $e){

        }
    }

}
