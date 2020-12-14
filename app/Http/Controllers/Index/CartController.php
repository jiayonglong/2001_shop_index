<?php
namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\ProductModel;
use PhpParser\Node\Stmt\Foreach_;
use App\Model\GoodsAttrModel;
use App\Model\Goods_AttrModel;
use Illuminate\Support\Facades\Redis;
class CartController extends Controller
{
    public function cart(){
        
        $cart = $this->getdata();
       return view('cart.cart',compact('cart'));
    }

    //购物车数据
    public function getdata(){
    $user_id = Redis::hget('reg','user_id');
    if(!$user_id){
        return redirect('/login');
    }
    $data['user_id'] = $user_id;
    $url = "http://2001.shop.api.com/cart";
    $data_json = posturl($url,$data);
    //   print_r($data_json);die;
    return $data_json;
    }

    public function getattrprice(){
        $goods_attr_id = request()->goods_attr_id;
        $goods_id = request()->goods_id;
        // print_r($goods_id);die;
       $attr_price = Goods_AttrModel::whereIn('goods_attr_id',$goods_attr_id)
                    ->sum('attr_price');
                   //  dd($attr_price);
                //    print_r($attr_price);die;
        $shop_price=GoodsModel::where(['goods_id'=>$goods_id])->value('shop_price')+$attr_price;
        // print_r($shop_price);die;
       $shop_price = number_format($shop_price,2,".","");
       
    //   print_r($end_price);
       return json_encode(['code'=>0,'msg'=>'OK','data'=>$shop_price]);
    //    dd($end_price);
    }
    
   



    //购物车删除
    public function cart_del(){
        $user_id = Redis::hget('reg','user_id');
        if(!$user_id){
            return redirect('/login');
        }
        $data['user_id'] = $user_id;
        $data['cart_id'] = request()->cart_id;

        $url = "http://2001.shop.api.com/cart_del";
        $del_cart = posturl($url,$data);
       // dd($del_cart);
        // dd($del_cart['code']);
        if($del_cart['code']==0){
             return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>1,'msg'=>'操作繁忙。。。']);
        }
    }


    //减号
    public function buy_jian(){
        $user_id = Redis::hget('reg','user_id');
        $data['user_id'] = $user_id;
        $data['cart_id'] = request()->cart_id; 
        
        $url = "http://2001.shop.api.com/buy_jian";
        
        $buy_jian = posturl($url,$data);
        if($buy_jian['code'] == 0){
            return json_encode(['code'=>0,'msg'=>'OK','price'=>$buy_jian['data'][0]]);
        }else{
            return json_encode(['code'=>1,'msg'=>'不能再少了']);
        }
    }
    
    //加号
    public function buy_jia(){
        $user_id = Redis::hget('reg','user_id');
        $data['user_id'] = $user_id;
        $data['cart_id'] = request()->cart_id;
        
        $url = "http://2001.shop.api.com/buy_jia";
        
        $buy_jia = posturl($url,$data);
        if($buy_jia['code'] == 0){
            return json_encode(['code'=>0,'msg'=>'OK','price'=>$buy_jia['data'][0]]);
        }else{
            return json_encode(['code'=>1,'msg'=>$buy_jia['msg']]);
        }
    }
   
    //购物车总价格
    public function cart_zprice(){
        $user_id = Redis::hget('reg','user_id');
        $data['user_id'] = $user_id;
        $cart_ids = request()->cart_ids;
        $url = "http://2001.shop.api.com/cart_zprice";
        $zprice = posturl($url,$cart_ids);
        $zprices = $zprice['data'][0]['total'];
        if($zprices){
            return json_encode(['code'=>0,'msg'=>'OK','zprice'=>$zprices]);
        }else{
            return json_encode(['code'=>1,'msg'=>'Error']);
        }
    }
   
}

