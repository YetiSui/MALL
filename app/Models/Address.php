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
     * @author DuJingWen <github.com/DJWKK>
     * @param $number
     * @return mixed|null
     */
    public static function djw_getPhone($number){
        try{
            $data = self::where('Address_number','like','%'.$number.'%')
                ->select('User_id')
                ->get();
            return $data[0]['User_id'];
        }catch(\Exception $e){
            logError('查找失败',[$e->getMessage()]);
            return null;
        }
    }
}
