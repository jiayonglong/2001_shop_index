<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
use App\Model\Order_InfoModel;
use App\Model\Order_GoodsModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;
class UserController extends Controller
{
     public function getsondata(Request $request){
    	$region_id  = $request->region_id; 
    	$region_son = RegionModel::where('parent_id',$region_id)->get();
    	return json_encode(['code'=>0,'msg'=>'OK','data'=>$region_son]);
    }
    public function store(Request $request){
        // echo 1234;die;
         $callback=$request->callback;
        $post = $request->except(['_token','callback','_','search_type','search_val']);
        // print_r($post);
        foreach($post as $k=>$v){
            $data['consignee'] = $k;
        }
    //   print_r($post);
        $user_id=Redis::hget('reg','user_id');
        $post['user_id'] = $user_id;
       // print_r($post);exit;
         $res = UseraddressModel::insert($post);
         $address = array();
        
        // return redirect('/');die;
        if($res){
            $address =  UseraddressModel::where(['user_id'=>$user_id])->get();
            // print_r($address);
            $reg = new RegionModel;
             foreach($address as $k=>$v){
                $address[$k]->country = $reg->where('region_id',$v->country)->value('region_name'); 
                $address[$k]->province = $reg->where('region_id',$v->province)->value('region_name');
                $address[$k]->city = $reg->where('region_id',$v->city)->value('region_name');
                $address[$k]->district = $reg->where('region_id',$v->district)->value('region_name');
                $address[$k]->tel = substr($v->tel,0,3)."****".substr($v->tel,7,4);
            }
        //    var_dump($address);
        }
       // $address = $address->toArray();
        $data = array(
            'code'=>0,
            'msg'=>'ok',
            'data'=>$address
        );
      
            echo  $callback.'('.json_encode($data).')';
    }



    public function user(){
        $user_id = request()->user_id;

        //待付款订单
        $obligation = Order_InfoModel::where(['is_paid'=>0,'user_id'=>$user_id,'order_status'=>0,'is_deliver'=>0,'is_evaluate'=>0])->count();
        //待发货订单
        $deliver = Order_InfoModel::where(['is_paid'=>1,'user_id'=>$user_id,'order_status'=>0,'is_deliver'=>0,'is_evaluate'=>0])->count();
        //待确认订单
        $afrmm = Order_InfoModel::where(['is_paid'=>1,'user_id'=>$user_id,'order_status'=>0,'is_deliver'=>1,'is_evaluate'=>0])->count();
        //待评价
        $evaluate = Order_InfoModel::where(['is_paid'=>1,'user_id'=>$user_id,'order_status'=>1,'is_deliver'=>1,'is_evaluate'=>0])->count();

        $respoer = [
            'code'=>'0',
            'msg'=>'OK',
            'data'=>[
                'obligation'=>$obligation,
                'deliver'=>$deliver,
                'afrmm'=>$afrmm,
                'evaluate'=>$evaluate,
                'remote_addr' =>$_SERVER['REMOTE_ADDR'],
            ], 
        ];   

    	return json_encode($respoer);

    }


    public function obligation(){
        $user_id = request()->user_id;
        $obligation = Order_InfoModel::select('sh_order_goods.seuser_id','sh_order_info.*','sh_seuser.seuser_plone')->leftjoin('sh_order_goods','sh_order_info.order_id','=','sh_order_goods.order_id')->leftjoin('sh_seuser','sh_order_goods.seuser_id','=','sh_seuser.seuser_id')->where(['user_id'=>$user_id])->get()->toArray();

        // 待付款订单
        // $obligation = Order_InfoModel::select('order_id','order_sn','is_paid','order_status','is_deliver','is_evaluate')->where(['user_id'=>$user_id])->get()->toArray();
        if(count($obligation) <= 0){
            $respoer = [
                'code'=>'1',
                'msg'=>'您没有未付款订单', 
            ];   
        }

        $order_goods_data=[];
        foreach($obligation as $k=>$v){
            $v['goods_data'] = Order_GoodsModel::where('order_id',$v['order_id'])->get()->toArray();
            $order_goods_data[]=$v;
            $goods_data_img = [];
            foreach($v['goods_data'] as $kk=>$vv){
                $vv['goods_img'] = GoodsModel::where('goods_id',$vv['goods_id'])->value('goods_img');
                $goods_data_img[] = $vv;
            }
            $order_goods_data[$k]['goods_data'] = $goods_data_img;
        }
        $respoer = [
            'code'=>'0',
            'msg'=>'OK',
            'data'=>$order_goods_data
        ];   
    	return json_encode($respoer);

    }


}
