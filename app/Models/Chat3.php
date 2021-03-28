<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat3 extends Model
{
    protected $table = "chat3";
    public $timestamps = true;
    protected $primaryKey = "chat3_id";
    protected $guarded = [];


    /**
     *买家所有消息
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showbAllMessages($userId){
        try {

            $res = Chat3::where('User_id','=',$userId)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }


    /**
     *买家骑手消息详情
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showMessageDetails($userId,$RiderId){
        try {

            $res = Chat1::where('Rider_id','=',$RiderId)
                ->where('User_id','=',$userId)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }



    /**
     *买家发送消息
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */

    public static function wdz_SendMessage($RiderId,$userId,$chatText){
        try {

            $res = Chat1::insert([
                'Rider_id'=>$RiderId,
                'User_id'=>$userId,
                'Chat_text'=>$chatText
            ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }
}
