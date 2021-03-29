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
