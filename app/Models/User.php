<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "user_id";
    protected $guarded = [];

    /**

     *展示个人信息
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_show($userId){
        try {
            $res = User::where('User_id','=',$userId)
                ->get();
            return $res ?
                $res :
                false;

        }catch (\Exception $e){

        }

/**
     * @param $user_id
     * @return |null
     * 获取用户地址 两次用到。
     */
    public static function djw_getAddress($user_id){
        try{
            $data = self::Join('address','user.User_id','address.User_id')
                ->where('address.User_id','=',$user_id)
                ->select('address.Address_id','address.Address_name','address.Address_Gender','address.Address_number','address.Address_Position')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('地址查找失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $user_id
     * @return |null
     */
    public static function djw_getPhone($user_id){
        try{
            $data = self::Join('order','user.User_id','order.User_id')
                ->Join('rider','order.Rider_id','rider.Rider_id')
                ->where('user.User_id','=',$user_id)
                ->select('order.Rider_id','rider.Rider_number')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('骑手手机号查找失败',[$e->getMessage()]);
            return null;
        }
    }


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $user_id
     * @return |null
     */
    public static function djw_getEvaluate($user_id){
        try{
            $data = self::Join('order','user.User_id','order.User_id')
                ->Join('store','store.Store_id','order.Store_id')
                ->Join('rider','order.Rider_id','rider.Rider_id')
                ->where('user.User_id','=',$user_id)
                ->select('rider.Rider_name','rider.Rider_photo','store.Store_name','store.Store_Avatar')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('骑手手机号查找失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $user_id
     * @param $order_star
     * @param $rider_star
     * @return |null
     */
    public static function djw_updateStatus($user_id,$order_star,$rider_star){
        try{
            $data = self::Join('order','user.User_id','order.User_id')
                ->Join('rider','order.Rider_id','rider.Rider_id')
                ->Join('store','order.Store_id','store.Store_id')
                ->where('user.User_id','=',$user_id)
                ->update([
                    'order.Order_evaluation'=>1,
                    'rider.Rider_score'=>$rider_star,
                    'store.Strore_score'=>$order_star
                ]);
            return $data;
        }catch(\Exception $e){
            logError('星级点评失败',[$e->getMessage()]);
            return null;
        }

    }

}
