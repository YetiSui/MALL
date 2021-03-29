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

    /**
     * 骑手所有消息（买家部分）
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id
     * $Rider_id 骑手编号
     * @return array
     */
    public static function cm_showAllMessages($Rider_id){
        try {

            $res = Chat1::where('Rider_id','=',$Rider_id)
                ->get();
            return $res ;
        }catch (\Exception $e){
            logError('骑手所有消息错误',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 骑手买家消息对话框
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id,$User_id
     * $Rider_id 骑手编号
     * $User_id 买家编号
     * @return array
     */
    public static function cm_showMessageDetails($Rider_id, $User_id){
        try {
            $res = Chat2::where('User_id','=',$User_id)
                ->where('Rider_id','=',$Rider_id)
                ->get();
            return $res ;
        }catch (\Exception $e){
            logError('骑手买家消息错误',[$e->getMessage()]);
            return null;
        }
    }

    /**
     *骑手发送消息给买家
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id,User_id，$Chat_text
     * $Rider_id 骑手编号
     * $User_id 买家编号
     * $Chat_text 内容
     * @return array
     */

    public static function cm_SendMessage($Rider_id,$Id,$Chat_text){
        try {
            $res = Chat2::insert([
                'Id'=>$Id,
                'Rider_id'=>$Rider_id,
                'Chat_text'=>$Chat_text
            ]);
            return $res ;
        }catch (\Exception $e){
            logError('骑手发送消息错误',[$e->getMessage()]);
            return null;
        }
    }

}
