<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat1 extends Model
{
    protected $table = "chat1";
    public $timestamps = true;
    protected $primaryKey = "chat1_id";
    protected $guarded = [];

    /**
     *商家所有消息
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showAllMessages($businessId){
        try {

            $res = Chat1::where('Business_id','=',$businessId)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }

    /**
     *商家买家消息详情
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showMessageDetails($businessId,$userId){
        try {

            $res = Chat1::where('Business_id','=',$businessId)
                ->where('User_id','=',$userId)
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

    public static function wdz_SendMessage($businessId,$userId,$chatText){
        try {

            $res = Chat1::insert([
                   'Business_id'=>$businessId,
                    'User_id'=>$userId,
                    'Chat_text'=>$chatText
                ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }

    //-------------------------------------------------------------------
    /**
     *买家所有消息
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showbAllMessages($userId){
        try {

            $res = Chat1::where('User_id','=',$userId)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){

        }
    }




}
