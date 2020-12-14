<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use App\Model\UseraddressModel;
use App\Model\CartModel;
use App\Model\RegionModel;
use App\Model\Order_GoodsModel;
use App\Model\Order_InfoModel;
use DB;
use Illuminate\Support\Facades\Redis;
use App\Model\CouponsModel;
use App\Model\User_CouponsModel;

class OrderController extends Controller
{
    /**提交订单页面收件人信息数据 */
    public function addressinfo(){
      $user_id=request()->input('user_id');
      $addressinfo = UseraddressModel::where(['user_id'=>$user_id,'is_del'=>1])->get();
      //展示收货人信息成中文的
        if($addressinfo){
            foreach($addressinfo as $k=>$v){
                // dd($k);
                $addressinfo[$k]['country_name'] = RegionModel::where('region_id',$v['country'])->value('region_name');
                $addressinfo[$k]['province_name'] = RegionModel::where('region_id',$v['province'])->value('region_name');
                $addressinfo[$k]['city_name'] = RegionModel::where('region_id',$v['city'])->value('region_name');
                $addressinfo[$k]['district_name'] = RegionModel::where('region_id',$v['district'])->value('region_name');
                $addressinfo[$k]->tel = substr($v->tel,0,3)."****".substr($v->tel,7,4);
            }  
        }
        $response = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'addressinfo'=>$addressinfo,
            ],
        ];
        return json_encode($response); 
        
    }

    /**api收货地址ajax删除 */
    public function address_del(){
        $user_id=request()->input('user_id');
        $address_id = request()->address_id;
        $count_address = UseraddressModel::where(['user_id'=>$user_id,'is_del'=>1])->count();
        $address_del = UseraddressModel::where(['user_id'=>$user_id,'address_id'=>$address_id])->update(['is_del'=>2]);
        if($address_del){
            $response = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>[
                    'address_del'=>$address_del,
                    'count_address'=>$count_address,
                ],
            ]; 
        }else{
            $response = [
                'code'=>1,
                'msg'=>'删除失败',
                'data'=>[],
            ]; 
        }

        return json_encode($response);

    }


        /**提交订单页面商品信息数据 */
        public function account(){
        $cart_ids = request()->input('cart_id');
       
        $price = DB::select("select SUM(shop_price*buy_number) as total FROM sh_cart where cart_id in ($cart_ids)");
       
        $cart_ids = explode(',',$cart_ids);

        $cart_data = CartModel::select('sh_cart.*','sh_goods.goods_img','sh_seuser.seuser_plone')
            ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
            ->leftjoin('sh_seuser','sh_goods.seuser_id','=','sh_seuser.seuser_id')
            ->whereIn('cart_id',$cart_ids)
            ->get();
            // print_r($cart_data);die;
                $goods_id=[];
                $coupons=[];
            foreach($cart_data as $k=>$v){
                $goods_id[]=$v['goods_id'];

                $attr = [];
                
                if(isset($v->goods_attr_id) && $v->goods_attr_id!=''){
                    $goods_attr_id = explode('|',$v->goods_attr_id);
                    foreach($goods_attr_id as $kk=>$vv){
                        $attr_data = Goods_AttrModel::select('sh_goods_attr.attr_value','sh_attribute.attr_name')
                                ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
                                ->where('goods_attr_id',$vv)
                                ->get();
                        $attr[] = $attr_data[0]['attr_name'].":".$attr_data[0]['attr_value'];
                       
                    }
                    
                
                    $v['attr'] = $attr;
                }
            }
            $coupons=$this->couponsuse($goods_id);
            // print_r($coupons);die; 
                $respoer = [
                    'code'=>0,
                    'msg'=>'OK',
                    'data'=>[
                        'cart_data'=>$cart_data,
                        'end_price'=>$price,
                        'coupons'=>$coupons
                    ],
                ];
            
        return json_encode($respoer);
        }
        //查询优惠券
        function couponsuse($goods_id){
        //    return $goods_id;
            // print_r($goods_id);die;
            // $cart_ids = request()->input('cart_id');
            // $goods_id=CartModel::where(['cart_id'=>$cart_ids])->value('goods_id');
        $user_id=Redis::hget('reg','user_id');
         $user_coupons =  User_CouponsModel::where(['user_id'=>$user_id,'coupons_state'=>0])->whereIn('goods_id',$goods_id)->get();
         $coupons_id=[];
         foreach($user_coupons as $v){
            $coupons_id[] = $v['coupons_id'];
         }         

        $coupons = CouponsModel::whereIn('coupons_id',$coupons_id)->get();
      
        return  $coupons;

        }
        //点击优惠券改变价格
        function couponsprice(){
            $goods_id = request()->goods_id;
            $goods_id=implode(',',$goods_id);
            $goods_id=explode(',',$goods_id);
            // print_r($goods_id);die;
            $goods_attr_id = request()->goods_attr_id;
            $goods_attr_id= explode('|',$goods_attr_id);
            $coupons_id = request()->coupons_id;
            $attr_price = Goods_AttrModel::whereIn('goods_attr_id',$goods_attr_id)
            ->sum('attr_price');
            // print_r($attr_price);die;            
               //  dd($attr_price);
                //    print_r($attr_price);die;
        $shop_price=GoodsModel::whereIn('goods_id',$goods_id)->sum('shop_price')+$attr_price;
        // print_r($shop_price);die;
        $coupons_price=CouponsModel::where(['coupons_id'=>$coupons_id])->value('coupons_price');
        // print_r($coupons_price);die;
        $deal_price=$shop_price-$coupons_price;
        // print_r($deal_price);die;
       $deal_price = number_format($deal_price,2,".","");
    //    return $goods_id;
       return json_encode(['code'=>0,'msg'=>'OK','data'=>$deal_price]);
        }

    /**执行提交订单 */
    public function orderdo(){
        
    }


    //修改默认收货地址
    public function mor(){
        $address_id = request()->input('address_id');
        $user_id = request()->input('user_id');
        
        $default = UseraddressModel::where(['user_id'=>$user_id])->update(['is_default'=>0]);
        $is_default =  UseraddressModel::where(['address_id'=>$address_id])->update(['is_default'=>1]);
        if($is_default){
            $respoer = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$is_default
            ];  
        }
        return json_encode($respoer);

    }



}
