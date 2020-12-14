<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\Goods_AttrModel;
use App\Model\GoodsAttrModel;
use Illuminate\Support\Facades\DB;
use App\Model\ProductModel;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\Redis;
class CartController extends Controller
{   
    //购物车列表数据
    public function cartdata(){
        $user_id = request()->input('user_id');

        $cart_data = CartModel::select('sh_cart.*','sh_goods.goods_img')
                    ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
                    ->where(['user_id'=>$user_id])
                    ->get();

        foreach ($cart_data as $key=>$val){
            $attr_name =[];
            $val->goods_attr_id = trim($val->goods_attr_id,'');

            if($val->goods_attr_id && $val->goods_attr_id!==''){
                $goods_attr_id = explode("|",$val->goods_attr_id);
                if(count($goods_attr_id)){
                    foreach($goods_attr_id as $k=>$v){
                        $attr_Data=Goods_AttrModel::select('sh_goods_attr.attr_value','sh_attribute.attr_name')
                            ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
                            ->where(['goods_attr_id'=>$v])
                            ->get();
                        $attr_name[]= $attr_Data[0]['attr_name'].":".$attr_Data[0]['attr_value'];               
                    }
                    $val['attr_nane']=$attr_name;
                }
            }

        }
        if(!count($cart_data)){
            $respoer = [
                'code'=>1,
                'msg'=>'您的购物车中没有商品',
                'data'=>[],
            ];
        }else{
            $respoer = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$cart_data 
            ];
        }
    	return json_encode($respoer);
    }

    //购物车商品数量
    public function cart_count(){
        $user_id = request()->input('user_id');
        $cart_count = CartModel::where(['user_id'=>$user_id,'is_del'=>1])->count();
        $respoer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>$cart_count,
        ];
    	return json_encode($respoer);
    }

    //购物车删除
    public function cart_del(){
        $user_id = request()->input('user_id');
        $cart_id = request()->input('cart_id');
        
        $del = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->delete();
        if($del){
            $respoer = [
                'code'=>'0',
                'msg'=>'OK',
                'data'=>$del,
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

    //减号
    public function buy_jian(){
        $user_id = request()->input('user_id');

        $cart_id = request()->input('cart_id');
        $buy = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->value('buy_number');
        if($buy > 1){
            $buy2 = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->decrement('buy_number');  
            $price = DB::select("SELECT (buy_number*shop_price) as price FROM `sh_cart` where cart_id=$cart_id");
            $respoer = [
                'code'=>'0',
                'msg'=>'OK',
                'data'=>$price 
            ];   
        }else{
            $respoer = [
                'code'=>'1',
                'msg'=>'不能再少了'
            ];
        }
    	return json_encode($respoer);
    }

    //加号
    public function buy_jia(){
        $user_id = request()->input('user_id');

        $cart_id = request()->input('cart_id');

        $buy = CartModel::select('sh_cart.buy_number','sh_goods.goods_number')
                ->leftjoin('sh_goods','sh_cart.goods_id','=','sh_goods.goods_id')
                ->where(['user_id'=>$user_id,'cart_id'=>$cart_id])
                ->first();
        if(!$buy['buy_number'] || !$buy['goods_number']){
            $respoer = [
                'code'=>'4',
                'msg'=>'该商品不存在'
            ];   
            return json_encode($respoer);die;
        }

        if($buy['buy_number'] < $buy['goods_number']){
            $buy3 = CartModel::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->increment('buy_number');  
            if($buy3){
                $price = DB::select("SELECT (buy_number*shop_price) as price FROM `sh_cart` where cart_id=$cart_id");
                $respoer = [
                    'code'=>'0',
                    'msg'=>'OK',
                    'data'=>$price 
                ];   
                return json_encode($respoer);die;
            }else{
                $respoer = [
                    'code'=>'3',
                    'msg'=>'操作繁忙...'
                ];
                return json_encode($respoer);die;
            }
        }else{
            $respoer = [
                'code'=>'2',
                'msg'=>'亲，存库不足了！'
            ];
            return json_encode($respoer);die;
        }
    }


        //购物车总价格
        public function cart_zprice(){
            $user_id = request()->input('user_id');

            $cart_ids = request()->all()?:request()->getContent();
            $cart_ids = implode(',',$cart_ids);
             $total = DB::select("select sum(buy_number*shop_price) as total from sh_cart where cart_id in ($cart_ids)");
            $respoer = [
                'code'=>'0',
                'msg'=>'OK',
                'data'=>$total
            ];   
            return json_encode($respoer);


        }

        
        public function is_not_json($str){
            return is_null(json_decode($str));
        }

         //加入购物车
    public function addcart(Request $request){
        $user_id = Redis::hget('reg','user_id');
        // dd($user_id);
        if(!$user_id){
            return json_encode(['code'=>'1001','msg'=>'请先登录']);
        }
            $goods_id=$request->goods_id;
            $buy_number= $request->buy_number;
            $seuser_id=GoodsModel::where('goods_id',$goods_id)->value('seuser_id');
            
            // print_r($seuser_id);die;
            $goods_attr_id= $request->goods_attr_id;
            if(isset($goods_attr_id)){
                $attr_price = Goods_AttrModel::whereIn('goods_attr_id',$goods_attr_id)
                ->sum('attr_price');
                $shop_price=GoodsModel::where(['goods_id'=>$goods_id])->value('shop_price');
                $shop_price = $attr_price + $shop_price;



                //echo $shop_price;exit;
               $shop_price = number_format($shop_price,2,".","");
            }else{
                $shop_price=GoodsModel::where(['goods_id'=>$goods_id])->value('shop_price');
                $shop_price = number_format($shop_price,2,".","");
            }
            //print_r($shop_price);die;
        // $data=json_encode($data);
        
        // dd($data);

        // 判断商品id 购买数量 是否缺少参数
        if(!$goods_id || !$buy_number){
            return  json_encode(['code'=>'1003','msg'=>'缺少参数']);
        }
        $goods = GoodsModel::select('goods_id','goods_name','shop_price','is_show','goods_number','goods_sn')->where('goods_id',$goods_id)->first();
        // dd($goods);
        // dd($goods['is_show']);
        if($goods->is_show==0){
            return  json_encode(['code'=>'1004','msg'=>'商品已下架']);
        }
         //查询product的库存 购买数量大于库存  提示库存不足
        if(isset($goods_attr_id)){
            $goods_attr_id = implode('|',$goods_attr_id); //imploade 将数组用|分割成字符串
            // dump($goods_attr_id);
            // echo 123;
            $product = ProductModel::select('product_id','product_number','product_sn')->where(['goods_id'=>$goods_id,'goods_attr'=>$goods_attr_id])->first();

            if($product['product_number']>$buy_number){
                return json_encode(['code'=>'1005','msg'=>'商品库存不足']);
            }
        }else{
             $goods_number = GoodsModel::select('goods_id','goods_number','goods_sn')->where(['goods_id'=>$goods_id])->first();
            //  dump($goods_number);
             if($goods_number->goods_number<$buy_number){
                return json_encode(['code'=>'1005','msg'=>'商品库存不足']);
            }
        }
            //根据当前用户id ，商品id和规格判断购物车是否有次商品  没有添加入库  有更新购买数量
        //购买数量大于库存提示 把购物车数量改为最大库存 更新
        $cart = CartModel::where(['user_id'=>$user_id,'goods_id'=>$goods_id,'goods_attr_id'=>$goods_attr_id])->first();
        // print_r($cart);die;
        // dd($cart);
        if($cart){
            //更新购买数量

            $buy_number = $cart['buy_number']+$buy_number;
            $res = CartModel::where('cart_id',$cart->cart_id)->update(['buy_number'=>$buy_number]);
            if($res){
                return json_encode(['code'=>'0','msg'=>'添加成功']);
            }else{
                  return json_encode(['code'=>'3','msg'=>'添加失败']);
            }
        }else{
            //echo $shop_price;exit;
              //添加购物车
            $data = [
                'user_id'=>$user_id,
                'product_id'=>$product->product_id??0,
                'buy_number'=>$buy_number,
                'goods_attr_id'=>$goods_attr_id??'',
                'goods_sn'=>$product->product_sn??$goods->goods_sn,
                'shop_price'=>$shop_price,
                'seuser_id'=>$seuser_id??''
            ];
            $goods = $goods?$goods->toArray():[];
            unset($goods['shop_price']);
            $data = array_merge($data,$goods);
            unset($data['is_show']);
            unset($data['goods_number']);
            $res = CartModel::create($data);
            // dd($res);
            if($res){
                return json_encode(['code'=>'0','msg'=>'添加成功']);
            }else{
                return json_encode(['code'=>'1','msg'=>'添加失败']);
            }
        }
           
    }

   
}
