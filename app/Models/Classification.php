<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = "classification";
    public $timestamps = true;
    protected $primaryKey = "classification_id";
    protected $guarded = [];

    /**
     * 展示所有分类
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $store_id
     * @return json
     */
    public static function zc_show(){
        try{
            $res = self::get();
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 添加类别
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $classification_name
     * @return json
     */
    public static function zc_new($classification_name){
        try{
            $res = self::create([
                'Classification_name'=>$classification_name
            ]);
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 删除类别
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $classification_id
     * @return json
     */
    public static function zc_delete($classification_id){
        try{
            $res = self::where('Classification_id',$classification_id)
                ->delete();
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }
}
