<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $table = "commodity";
    public $timestamps = true;
    protected $primaryKey = "commodity_id";
    protected $guarded = [];


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $store_id
     * @return |null
     */
    public static function djw_getMenus($store_id){
        try{
            $data = self::Join('classification','commodity.Classification_id','classification.Classification_id')
                ->where('commodity.Store_id','=',$store_id)
                ->select('classification.Classification_id','classification.Classification_name')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('商家左侧分类展示成功',[$e->getMessage()]);


    /**
     * 展示分类下商品
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $store_id ,$classification_id
     * @return json
     */
    public static function zc_show($store_id ,$classification_id){
        try{
            $res = self::where('Store_id',$store_id)
            ->where('Classification_id',$classification_id)
            ->get();
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

            return null;
        }
    }



    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $value
     * @return |null
     */
    public static function getSearch($value){
        try{
            $data = self::where('Commodity_name','like','%'.$value.'%')
                ->select('classification.Classification_id','classification.Classification_name')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('商家左侧分类展示成功',[$e->getMessage()]);

    /**
     * 回显指定商品
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $commodity_id
     * @return json
     */
    public static function zc_find($commodity_id){
        try{
            $res = self::where('Commodity_id',$commodity_id)
                ->get();
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

            return null;
        }
    }

    /**

     * @author DuJingWen <github.com/DJWKK>
     * @param $classification_id
     * @return |null
     */
    public static function djw_getGoods($classification_id){
        try{
            $data = self::where('Classification_id','=',$classification_id)
                ->select('Commodity_name','Commodity_number','Commodity_photo','Commodity_price','Commodity_Sales')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('商家左侧分类展示成功',[$e->getMessage()]);

     * 展示分类下商品
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $store_id ,$commodity_id ,$commodity_name ,$commodity_photo ,$commodity_number ,$commodity_price
     * @return json
     */
    public static function zc_new($store_id ,$commodity_id ,$commodity_name ,$commodity_photo ,$commodity_number ,$commodity_price)
    {
        try {
            $res = self::create([
                'Store_id' => $store_id,
                'Classification_id' => $commodity_id,
                'Commodity_name' => $commodity_name,
                'Commodity_photo' => $commodity_photo,
                'Commodity_number' => $commodity_number,
                'Commodity_price' => $commodity_price,
                'Commodity_Sales' => 0
            ]);
            return $res;
        } catch (Exception $e) {
            logError("存入失败", [$e->getMessage()]);

            return null;
        }
    }

    /**

     * @author DuJingWen <github.com/DJWKK>
     * @param $content
     * @return |null
     */
    public static function djw_getContent($content){
        try{
            $data = self::where('Commodity_name','like','%'.$content.'%')
                ->select('Commodity_name','Commodity_number','Commodity_photo','Commodity_price','Commodity_Sales')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('搜索成功',[$e->getMessage()]);

     * 修改库存价格
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $commodity_id ,$commodity_number ,$commodity_price
     * @return json
     */
    public static function zc_update($commodity_id ,$commodity_number ,$commodity_price){
        try{
            $res = self::where('Commodity_id',$commodity_id)
                ->update([
                    'Commodity_number'=>$commodity_number,
                    'Commodity_price'=>$commodity_price
                ]);
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $commodity_id
     * @return |null
     */
    public static function djw_getShop($commodity_id){
        try{
            echo $commodity_id;
            $data = self::where('Commodity_id','=',$commodity_id)
                ->select('Commodity_name','Commodity_photo','Commodity_price','Store_id')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('搜索成功',[$e->getMessage()]);

     * 下架
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $commodity_id ,$commodity_number ,$commodity_price
     * @return json
     */
    public static function zc_updatestatus($commodity_id){
        try{
            $res = self::where('Commodity_id',$commodity_id)
                ->delete();
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

            return null;
        }
    }

    /**

     * @param $Commodity_id
     * @return |null
     */
    public static function djw_getCommodity($Commodity_id){
        try{
            $data = self::Join('store','commodity.Store_id','store.Store_id')
                ->Join('order','order.Store_id','commodity.Store_id')
                ->where('Commodity_id','=',$Commodity_id)
                ->select('commodity.Commodity_name','commodity.Commodity_photo','commodity.Commodity_price','store.Store_name','store.Store_Avatar','order.Order_evaluation','order.Order_Audit')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('搜索成功',[$e->getMessage()]);

     * 修改库存价格
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $commodity_id ,$commodity_name ,$commodity_photo
     * @return json
     */
    public static function zc_updategoods($commodity_id ,$commodity_name ,$commodity_photo){
        try{
            $res = self::where('Commodity_id',$commodity_id)
                ->update([
                    'Commodity_name'=>$commodity_name,
                    'Commodity_photo'=>$commodity_photo
                ]);
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

            return null;
        }
    }
}
