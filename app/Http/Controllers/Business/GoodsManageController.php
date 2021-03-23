<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteClassifyRequest;
use App\Http\Requests\FindeGoodsRequest;
use App\Http\Requests\NewClassifyRequest;
use App\Http\Requests\NewGoodsRequest;
use App\Http\Requests\ShowAllClassifyRequest;
use App\Http\Requests\ShowAllGoodsRequest;
use App\Http\Requests\UpdateGoodsRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Classification;
use App\Models\Commodity;
use Illuminate\Http\Request;

class GoodsManageController extends Controller
{
    /**
     * 展示分类下商品
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  ShowAllGoodsRequest $request
     * @return json
     */
    public static function showAllGoods(ShowAllGoodsRequest $request){
        $res = Commodity::zc_show($request['Store_id'],$request['Classification_id']);
        return $res?
            json_success('展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }

    /**
     * 展示所有类别
     * @auther ZhongChun <github.com/RobbEr929>
     * @return json
     */
    public static function showAllClassify(){
        $res = Classification::zc_show();
        return $res?
            json_success('展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }

    /**
     * 回显指定商品
     * @auther ZhongChun <github.com/RobbEr929>
     * @param FindeGoodsRequest $request
     * @return json
     */
    public static function findGoods(FindeGoodsRequest $request){
        $res = Commodity::zc_find($request['Commodity_id']);
        return $res?
            json_success('展示成功!',$res,200):
            json_fail('展示失败!',null,100);
    }

    /**
     * 添加商品
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  NewGoodsRequest $request
     * @return json
     */
    public static function newGoods(NewGoodsRequest $request){
        if(!$request->hasFile('Commodity_photo')){
            dd('文件不存在');
        }
        $img = $request->file('Commodity_photo');
        $path = $img->store('public/Commodity_photo'.date('Ymd'));
        $res = Commodity::zc_new($request['Store_id'],$request['Classification_id'],$request['Commodity_name'],$path,$request['Commodity_number'],$request['Commodity_price']);
        return $res?
            json_success('添加成功!',null,200):
            json_fail('添加失败!',null,100);
    }

    /**
     * 添加类别
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  NewClassifyRequest $request
     * @return json
     */
    public static function newClassify(NewClassifyRequest $request){

        $res = Classification::zc_new($request['Classification_name']);
        return $res?
            json_success('添加成功!',null,200):
            json_fail('添加失败!',null,100);
    }

    /**
     * 修改库存价格
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  UpdateStockRequest $request
     * @return json
     */
    public static function updateStock(UpdateStockRequest $request){

        $res = Commodity::zc_update($request['Commodity_id'] ,$request['Commodity_number'] ,$request['Commodity_price']);
        return $res?
            json_success('修改成功!',null,200):
            json_fail('修改失败!',null,100);
    }

    /**
     * 下架
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  UpdateStatusRequest $request
     * @return json
     */
    public static function updateStatus(UpdateStatusRequest $request){
        $res = Commodity::zc_updatestatus($request['Commodity_id']);
        return $res?
            json_success('下架成功!',null,200):
            json_fail('下架失败!',null,100);
    }

    /**
     * 修改商品名和所属类别
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  UpdateGoodsRequest $request
     * @return json
     */
    public static function updateGoods(UpdateGoodsRequest $request){
        if(!$request->hasFile('Commodity_photo')){
            dd('文件不存在');
        }
        $img = $request->file('Commodity_photo');
        $path = $img->store('public/Commodity_photo'.date('Ymd'));
        $res = Commodity::zc_updategoods($request['Commodity_id'] ,$request['Commodity_name'] ,$path);
        return $res?
            json_success('修改成功!',null,200):
            json_fail('修改失败!',null,100);
    }

    /**
     * 删除类别
     * @auther ZhongChun <github.com/RobbEr929>
     * @param  DeleteClassifyRequest $request
     * @return json
     */
    public static function deleteClassify(DeleteClassifyRequest $request){
        $res = Classification::zc_delete($request['Classification_id']);
        return $res?
            json_success('删除成功!',null,200):
            json_fail('删除失败!',null,100);
    }
}
