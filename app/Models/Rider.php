<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Rider extends \Illuminate\Foundation\Auth\User implements JWTSubject,\Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable;
    public $table = 'rider';
    protected $rememberTokenName = NULL;

    protected $primaryKey = 'rider_id';


    protected $primaryKey = 'Rider_id';


    protected $guarded = [];
    protected $hidden = [
        'Rider_password',
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
     * 创建骑手
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


    /**
     *
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $indexOf
     * @return json
     */
    public static function zc_show($indexOf){
        try{
            if($indexOf==0){
                $res = self::select('*')
                    ->get();
            }
            if($indexOf==1){
                $res = self::select('*')
                    ->where('Rider_Audit','0')
                    ->get();
            }
            if($indexOf==2){
                $res = self::select('*')
                    ->where('Rider_Audit','1')
                    ->get();
            }
            if($indexOf==3){
                $res = self::select('*')
                    ->where('Rider_Audit','2')
                    ->get();
            }

            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

    /**
     * 骑手系统我的界面个人信息
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id
     * $Rider_id 骑手编号
     * @return array
     */
    Public static function cm_riderInfo($Rider_id){
        try{
            $data=self::select('Rider_name','Rider_photo','Rider_State','Rider_wallet')
                ->where('Rider_id',$Rider_id)
                ->get();
            return $data;
        }catch (\Exception $e){
            logError('骑手系统首页确认送出错误',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 骑手系统上传个人信息
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id
     * $Rider_id 骑手编号
     * @return array
     */
    Public static function cm_infoUpload($Rider_id,$Rider_name,$path){
        try{
            $data=self::where('Rider_id',$Rider_id)
                ->update(['Rider_name'=>$Rider_name,
                           'Rider_photo'=>$path]);

            return $data;
        }catch (\Exception $e){
            logError('骑手系统上传个人信息错误',[$e->getMessage()]);

            return null;
        }
    }

    /**

     * 审核骑手
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $store_id ,$store_audit ,$operation
     * @return json
     */
    public static function zc_audit($reder_id ,$Rider_Audit ,$operation){
        try{
            if($Rider_Audit==0) {
                if($operation==0) {
                    $res = self::where('Rider_id', $reder_id)
                        ->update([
                            'Rider_Audit'=>1
                        ]);
                }
                if($operation==1) {
                    $res = self::where('Rider_id', $reder_id)
                        ->update([
                            'Rider_Audit'=>2
                        ]);
                }
            }
            if($Rider_Audit==1) {
                $res = self::where('Rider_id', $reder_id)
                    ->update([
                        'Rider_Audit'=>2
                    ]);
            }
            if($Rider_Audit==2) {
                $res = self::where('Rider_id', $store_id)
                    ->update([
                        'Rider_Audit'=>1
                    ]);
            }
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);
            return null;
        }
    }
/**
     * 骑手系统上传身份认证
     * @author ChenMiao <github.com/Yidaaa-u>
     * @param String $Rider_id
     * $Rider_id 骑手编号
     * @return array
     */
    Public static function cm_idenUpload($Rider_id,$Rider_name,$path,$Id_number){
        try{
            $data=self::where('Rider_id',$Rider_id)
                ->update(['Rider_name'=>$Rider_name,
                    'Id_number'=>$Id_number,
                    'Id_photo'=>$path]);
            return $data;
        }catch (\Exception $e){
            logError('骑手系统上传身份认证错误',[$e->getMessage()]);
            return null;
        }
    }

}
