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



    /**
     * 骑手所有消息预览（商家部分）
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id
     * $Rider_id 骑手编号
     * @return array
     */
    public static function cm_showAllMessages($Rider_id){
        try {
            $res = Chat2::where('Rider_id','=',$Rider_id)
                ->get();
            return $res ;
        }catch (\Exception $e){
            logError('骑手所有消息错误',[$e->getMessage()]);
            return null;

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

/**
     * 骑手商家消息对话框
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id,$Business_id
     * $Rider_id 骑手编号
     * $Business_id 商家编号
     * @return array
     */
    public static function cm_showMessageDetails($Rider_id, $Business_id){
        try {
            $res = Chat2::where('Business_id','=',$Business_id)
                ->where('Rider_id','=',$Rider_id)
                ->get();
            return $res ;
        }catch (\Exception $e){
            logError('骑手商家消息错误',[$e->getMessage()]);
            return null;

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
/**
     *骑手发送消息给商家
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id,$Business_id，$Chat_text
     * $Rider_id 骑手编号
     * $Business_id 商家编号
     * $Chat_text 内容
     * @return array
     */

    public static function cm_SendMessage($Rider_id,$Id,$Chat_text){
        try {
            $res = Chat2::insert([
                'Business_id'=>$Id,
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
