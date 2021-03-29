<?php

namespace App\Models;

use Carbon\Carbon;
use http\Exception;
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


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getFood(){
        try{
            $data = self::where('Store_Category','=','1')
                ->select('Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品id失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $store_id
     * @return |null
     */
    public static function djw_getPublic($store_id){
        try{
            $data = self::Join('coupons','store.Store_id','coupons.Store_id')
                ->where('coupons.Store_id','=',$store_id)
                ->select('store.Store_name','store.Strore_Sales','store.Store_Avatar','coupons.Coupons_Reducing','coupons.Coupons_Meet')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('查找失败',[$e->getMessage()]);
            return null;
        }
    }


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getSuper(){
        try{
            $data = self::where('Store_Category','=','2')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺失败',[$e->getMessage()]);


    /**
     * 展示所有店铺
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
                    ->where('Store_Audit','0')
                    ->get();
            }
            if($indexOf==2){
                $res = self::select('*')
                    ->where('Store_Audit','1')
                    ->get();
            }
            if($indexOf==3){
                $res = self::select('*')
                    ->where('Store_Audit','2')
                    ->get();
            }

            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

            return null;

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
     *@auther wangdezhi
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

/**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getMedicine(){
        try{
            $data = self::where('store.Store_Category','=','3')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);
/**
     * 审核店铺
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $store_id ,$store_audit ,$operation
     * @return json
     */
    public static function zc_audit($store_id ,$store_audit ,$operation){
        try{
            if($store_audit==0) {
                if($operation==0) {
                    $res = self::where('Store_id', $store_id)
                        ->update([
                            'Store_Business_status'=>0,
                            'Store_Audit'=>1
                        ]);
                }
                if($operation==1) {
                    $res = self::where('Store_id', $store_id)
                        ->update([
                            'Store_Audit'=>2
                        ]);
                }
            }
            if($store_audit==1) {
                $res = self::where('Store_id', $store_id)
                    ->update([
                        'Store_Business_status'=>1,
                        'Store_Audit'=>2
                    ]);
            }
            if($store_audit==2) {
                $res = self::where('Store_id', $store_id)
                    ->update([
                        'Store_Business_status'=>0,
                        'Store_Audit'=>1
                    ]);
            }
            return $res;
        }catch (Exception $e){
            logError("存入失败",[$e->getMessage()]);

            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getDessert(){
        try{
            $data = self::where('store.Store_Category','=','4')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);

    public static function zc_showhomepage($store_id)
    {
        try {
            $today = date('Y-m-d').' 00:00:00';
            $yestoday = date('Y-m-d',time()-86400).' 00:00:00';
            $res['store'] = self::select('*')
                ->where('Store_id', $store_id)
                ->get();
            $res['Order_count'] = Order::where('Store_id', $store_id)
                ->where('Order_Audit_time4','>=',$today)
                ->count();
            $res['Order_total'] = Order::where('Store_id', $store_id)
                ->where('Order_Audit_time4','>=',$today)
                ->sum('Orderf_Amount');
            $res['Order_countyes'] = Order::where('Store_id', $store_id)
                ->where('Order_Audit_time4','<=',$today)
                ->where('Order_Audit_time4','>=',$yestoday)
                ->count();
            $res['Order_totalyes'] = Order::where('Store_id', $store_id)
                ->where('Order_Audit_time4','<=',$today)
                ->where('Order_Audit_time4','>=',$yestoday)
                ->sum('Orderf_Amount');
            $rank = self::select('*')
                ->count();
            $res['rank'] = random_int(1,$rank);
            $res['custom'] = $res['Order_countyes'];
            return $res;
        } catch (Exception $e) {
            logError("存入失败", [$e->getMessage()]);

            return null;
        }
    }


    /**
     * @author DuJingWen <github.com/DJWKK>
     * @return mixed|null
     */
    public static function djw_getFruit(){
        try{
            $data = self::where('store.Store_Category','=','5')
                ->select('store.Store_id')
                ->get();
            return $data[0]['Store_id'];
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $content
     * @return |null
     */
    public static function djw_getSearch($content){
        try{
            $data = self::Join('coupons','store.Store_id','coupons.Store_id')
                ->where('store.Store_name','like','%'.$content.'%')
                ->select('store.Store_name','store.Store_Avatar','store.Strore_Sales','coupons.Coupons_Meet','coupons.Coupons_Reducing')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('店铺搜索失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * @author DuJingWen <github.com/DJWKK>
     * @param $store_id
     * @return |null
     */
    public static function djw_getTitle($store_id){
        try{
            $data = self::where('Store_id','=',$store_id)
                ->select('Store_name','Store_Avatar','Strore_Sales','Store_Notice','Strore_score')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取美食商品店铺成功',[$e->getMessage()]);
            return null;
        }
    }


    public static function zc_update($store_id,$store_name,$store_category,$store_avatar,$store_business_status,$store_notice,$store_number,$store_address){
        try {
            $res = self::where('Store_id',$store_id)
            ->update([
            'Store_name'=>$store_name,
            'Store_Category'=>$store_category,
            'Store_Avatar'=>$store_avatar,
            'Store_Business_status'=>$store_business_status,
            'Store_Notice'=>$store_notice,
            'Store_number'=>$store_number,
            'Store_Address'=>$store_address
            ]);
            return $res;
        } catch (Exception $e) {
            logError("存入失败", [$e->getMessage()]);
            return null;
        }
    }

}
