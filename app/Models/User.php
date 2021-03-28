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

    }

}
