<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\Shop_HistoryModel;
use App\Model\CollectModel;
use App\Model\CouponsModel;
use App\Model\User_CouponsModel;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    
    public function goods($id){
       //商品基本信息
       $goodsinfo=GoodsModel::leftjoin('sh_brand','sh_goods.brand_id','=','sh_brand.brand_id')->where('sh_goods.goods_id',$id)->get();
       foreach($goodsinfo as $v){
        $cat_id=$v['cat_id'];
       }
      
       $recommended=GoodsModel::where(['cat_id'=>$cat_id])->get();
        //商品规格
        $attr = Goods_AttrModel::select('goods_attr_id','sh_goods_attr.attr_id','sh_attribute.attr_name','sh_goods_attr.attr_value')
        ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
        ->where(['goods_id'=>$id,'sh_attribute.attr_type'=>1])
        ->get();
        $new_attr=[];
        if($attr){
            foreach($attr as $k => $v){
                $new_attr[$v['attr_id']]['attr_name'] = $v['attr_name'];
                $new_attr[$v['attr_id']]['attr_value'][$v['goods_attr_id']] = $v['attr_value'];
            }
           $data1=['goodsinfo'=>$goodsinfo,'attr'=>$new_attr,'recommended'=>$recommended];
  
           return json_encode($data1);
        }else{
            $data2=['goodsinfo'=>$goodsinfo,'attr'=>$attr,'recommended'=>$recommended];
    
            return json_encode($data2);
        }
        
    }

    //领取优惠券视图
    public function coupons(){
        $id = request()->goods_id;
        // return $id;
        $data=CouponsModel::where(['goods_id'=>$id])->get();
        // print_r($data);die;
        return $data;
    }

    /**API个人收藏  添加*/
    public function createcollect(){
        $data= request()->all();
        $user_id=Redis::hget('reg','user_id');
        $data['user_id'] = $user_id;

        if(!$user_id){
            return json_encode(['code'=>'1001','msg'=>'请先登录']);
        }
        $count = CollectModel::where(['user_id'=>$user_id,'goods_id'=>$data['goods_id']])->count();
        //判断此用户是否收藏过此此商品
        if($count==1){
            return json_encode(['code'=>'1002','msg'=>'您已收藏过,可到收藏夹中查看']);
        }else{
            $collect = CollectModel::insert($data);
            if($collect){
                return json_encode(['code'=>'1003','msg'=>'收藏成功,可到收藏夹中查看']);
                
            }
        }
    }

    /**API个人收藏 展示 */
    public function listcollect(){
        //判断用户是否登录,未登录时去登录
        $user_id = request()->input('user_id');
        $collectgoodsInfo = CollectModel::select('sh_collect.*','sh_goods.goods_id','sh_goods.goods_img','sh_goods.goods_name','sh_goods.shop_price')
                            ->leftjoin('sh_goods','sh_collect.goods_id','=','sh_goods.goods_id')
                            ->where('sh_collect.user_id',$user_id)
                            ->get();                    
        $response = [       
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'collectgoodsInfo'=>$collectgoodsInfo
            ],
        ];
        return json_encode($response);
    }

    /**API取消个人收藏 */
    public function cancel(){
        $user_id = request()->input('user_id');
        $goods_id = request()->input('goods_id');
        $res = CollectModel::where(['user_id'=>$user_id,'goods_id'=>$goods_id])->delete();
        if($res){
            $respoer = [
                'code'=>'0',
                'msg'=>'OK',
                'data'=>$res,
            ];
        }else{
            $respoer = [
                'code'=>'1',
                'msg'=>'失败',
                'data'=>[],
            ];
        }
        return json_encode($respoer);

    }

    /**API登录后  添加历史浏览记录 */
    public function createhistory($goods_id){
        //获取用户id
        $user_id=Redis::hget('reg','user_id');
        //根据商品id判断此用户是否浏览过商品
        $history = Shop_HistoryModel::where(['user_id'=>$user_id,'goods_id'=>$goods_id])->count();
        if($history<1){
            $data = [
                'user_id'=>$user_id,
                'goods_id'=>$goods_id,
                'add_time'=>time()
            ];
            Shop_HistoryModel::insert($data);
        }else{
            Shop_HistoryModel::where(['user_id'=>$user_id,'goods_id'=>$goods_id])->update(['add_time'=>time()]);
        }
        return true;
    }
   
   
   
}
