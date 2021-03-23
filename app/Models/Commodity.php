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
