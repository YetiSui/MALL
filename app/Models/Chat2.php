<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat2 extends Model
{
    protected $table = "chat2";
    public $timestamps = true;
    protected $primaryKey = "chat2_id";
    protected $guarded = [];
    /**
     *商家所有消息
     * @auther
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showAllMessages($businessId){
        try {

            $res = Chat2::where('Business_id','=',$businessId)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }

    /**
     *商家聊天详情
     * @auther
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showMessageDetails($businessId,$userId){
        try {

            $res = Chat2::where('Business_id','=',$businessId)
                ->where('Rider_id','=',$userId)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }

    /**
     *商家发送消息
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */

    public static function wdz_SendMessage($businessId,$RiderId,$chatText){
        try {

            $res = Chat2::insert([
                'Business_id'=>$businessId,
                'Rider_id'=>$RiderId,
                'Chat_text'=>$chatText
            ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }
}
