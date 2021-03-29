<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Business extends \Illuminate\Foundation\Auth\User implements JWTSubject,\Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable;
    public $table = 'business';
    protected $rememberTokenName = NULL;

    protected $primaryKey = 'business_id';


    protected $primaryKey = 'Business_id';

    protected $guarded = [];
    protected $hidden = [
        'password',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getJWTIdentifier()
    {
        return self::getKey();
    }
    /**
     * 创建商家
     *
     * @param array $array
     * @return |null
     * @throws Exception
     */
    public static function createUser($array = [])
    {
        try {

            return self::create($array) ?
                true :
                false;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }

    public static function zc_register($business_number,$business_password){
        try{
            $res = self::create([
                'Business_number'=>$business_number,
                'Business_Password'=>$business_password
            ]);
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }
}
