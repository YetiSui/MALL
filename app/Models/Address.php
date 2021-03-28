<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "address";
    public $timestamps = true;
    protected $primaryKey = "address_id";
    protected $guarded = [];

    /**
     *展示所有地址
     * @auther wangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_show($userId){
        try {
            $res = Address::where('User_id','=',$userId)
                ->get();
            return $res ?
                $res :
                false;

        }catch (\Exception $e){

        }

    }

    /**
     *设置默认地址
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showDefault($addressId){
        try {
            Address::where('Address_State','=',1)
               ->update(['Address_State' => 0]);
            $res = Address::where('Address_id','=',$addressId)
                ->update(['Address_State'=>1])
                ->get();
            return $res ?
                $res :
                false;

        }catch (\Exception $e){

        }

    }

    /**
     *删除地址
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showDelete($addressId){
        try {
            $res = Address::where('Address_id','=',$addressId)
                ->delete();
            return $res ?
                $res :
                false;

        }catch (\Exception $e){

        }

    }

    /**
     *添加地址
     * @autherwangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showAddto($userId,$addressName,$addressGender,$addressNumber,$addressPosition){
        try {
            $res = Address::insert(
                [   'User_id'=>$userId,
                    'Address_name'=>$addressName,
                    'Address_Gender'=>$addressGender,
                    'Address_number'=>$addressNumber,
                    'Address_Position'=>$addressPosition,
                ]);
            return $res ?
                $res :
                false;

        }catch (\Exception $e){

        }

    }
}
