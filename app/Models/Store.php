<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "store";
    public $timestamps = true;
    protected $primaryKey = "store_id";
    protected $guarded = [];
    /**
     *商店展示
     * @auther wangdezhi
     * @param showRequest $request
     * @return json
     */
    public static function wdz_show($storeAudit){
        try {
            if ($storeAudit==0){
                $res = Store::get();
                return $res ?
                    $res :
                    false;
            }
            else if ($storeAudit==1){
                $res = Store::where('Store_Audit','=',0)
                    ->get();
                return $res ?
                    $res :
                    false;
            }
            else if ($storeAudit==2){
                $res = Store::where('Store_Audit','=',1)
                    ->get();
                return $res ?
                    $res :
                    false;
            }
            else if ($storeAudit==3){
                $res = Store::where('Store_Audit','=',2)
                    ->get();
                return $res ?
                    $res :
                    false;
            }
        }catch (\Exception $e){
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     *商店详情展示
     * @auther wangdezhi
     * @param xxxRequest $request
     * @return json
     */
    public static function wdz_showDetails($storeId){
        try {
            $res = Store::where('Store_id','=',$storeId)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e){
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    public static function wdz_newstore($businessId,$storeName,$stroreContact,$storeNumber,$storeCategory,$idPhoto,$storeLicense,$storeDocuments,$storePhoto){
        try {
            $res = Store::insert(
                [   'Business_id'=>$businessId,
                    'Store_name'=>$storeName,
                    'Strore_Contact'=>$stroreContact,
                    'Store_number'=>$storeNumber,
                    'Store_Category'=>$storeCategory,
                    'Id_Photo'=>$idPhoto,
                    'Store_License'=>$storeLicense,
                    'Store_Documents'=>$storeDocuments,
                    'Store_Photo'=>$storePhoto]
            );
            return $res ?
                $res :
                false;
        }catch (\Exception $e){
            logError('查询错误错误', [$e->getMessage()]);
            return false;
        }
    }
    /**
     *
     */

    public static function wdz_showstate($storeId){
        try {
            $res = Store::where('Store_id','=',$storeId)
                ->get('Store_Business_status');
            return $res ?
                $res :
                false;

        }catch(\Exception $e){
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
}
