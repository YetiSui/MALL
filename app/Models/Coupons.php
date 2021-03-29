<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = "coupons";
    public $timestamps = true;
    protected $primaryKey = "coupons_id";
    protected $guarded = [];

    /**
     * 展示优惠券
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  $store_id
     * @return json
     */
    public static function zc_show($store_id){
        try {
            $res = self::where('Store_id',$store_id)
                ->get();
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }

    /**
     *
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  $store_id ,$coupons_meet ,$coupons_reducing
     * @return json
     */
    public static function zc_new($store_id ,$coupons_meet ,$coupons_reducing){
        try {
            $res = self::create([
                    'Store_id'=>$store_id,
                    'Coupons_Meet'=>$coupons_meet,
                    'Coupons_Reducing'=>$coupons_reducing
                ]);
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 删除优惠券
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  $coupons_id
     * @return json
     */
    public static function zc_delete($coupons_id){
        try {
            $res = self::where('Coupons_id',$coupons_id)
                ->delete();
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }
}
