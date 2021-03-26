<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = "order_items";
    public $timestamps = true;
    protected $primaryKey = "order_id";
    protected $guarded = [];

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $Order_id
     * @return mixed|null
     */
    public static function djw_getCommodityId($Order_id){
        try{
            $data = self::where('Order_id','=',$Order_id)
                ->select('Commodity_id')
                ->get();
            return $data[0]['Commodity_id'];
        }catch(\Exception $e){
            logError('Commodity_id查找失败。',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $order_items_Amount
     * @param $commodity_id
     * @param $order_items_number
     * @return |null
     */
    public static function djw_addOrderItems($order_items_Amount,$commodity_id,$order_items_number){
        try{
            $data = self::create([
                    'commodity_id'=>$commodity_id,
                    'order_items_number'=>$order_items_number,
                    'order_items_Amount'=>$order_items_Amount
                ]);
            return $data;
        }catch(\Exception $e){
            logError('Commodity_id查找失败。',[$e->getMessage()]);
            return null;
        }
    }



}
