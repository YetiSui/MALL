<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "store";
    public $timestamps = true;
    protected $primaryKey = "store_id";
    protected $guarded = [];
    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getFood(){
        try{
            $data = self::where('Store_Category','=','1')
                ->select('Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品id失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $store_id
     * @return |null
     */
    public static function djw_getPublic($store_id){
        try{
            $data = self::Join('coupons','store.Store_id','coupons.Store_id')
                ->where('coupons.Store_id','=',$store_id)
                ->select('store.Store_name','store.Strore_Sales','store.Store_Avatar','coupons.Coupons_Reducing','coupons.Coupons_Meet')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('查找失败',[$e->getMessage()]);
            return null;
        }
    }


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getSuper(){
        try{
            $data = self::where('Store_Category','=','2')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getMedicine(){
        try{
            $data = self::where('store.Store_Category','=','3')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getDessert(){
        try{
            $data = self::where('store.Store_Category','=','4')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getFruit(){
        try{
            $data = self::where('store.Store_Category','=','5')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $content
     * @return |null
     */
    public static function djw_getSearch($content){
        try{
            $data = self::Join('coupons','store.Store_id','coupons.Store_id')
                ->where('store.Store_name','like','%'.$content.'%')
                ->select('store.Store_name','store.Store_Avatar','store.Strore_Sales','coupons.Coupons_Meet','coupons.Coupons_Reducing')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('店铺搜索失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $store_id
     * @return |null
     */
    public static function djw_getTitle($store_id){
        try{
            $data = self::where('Store_id','=',$store_id)
                ->select('Store_name','Store_Avatar','Strore_Sales','Store_Notice','Strore_score')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);
            return null;
        }
    }

}
