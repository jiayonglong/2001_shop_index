<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CouponsModel;
use App\Model\User_CouponsModel;
use Illuminate\Support\Facades\Redis;
class CouponsController extends Controller
{
    //领取优惠券
    public function couponsdo(){
        $coupons_id = request()->coupons_id;
        $user_id=Redis::hget('reg','user_id');
        $goods_id=CouponsModel::where('coupons_id',$coupons_id)->get();
        $data=[
            'user_id'=>$user_id,
            'coupons_id'=>$coupons_id,
            'goods_id'=>$goods_id[0]['goods_id']
        ];
        if(!$user_id){
            return json_encode(['code'=>'1001','msg'=>'请先登录']);
        }
        $un=User_CouponsModel::where(['coupons_id'=>$coupons_id,'user_id'=>$user_id])->first();
       
            if($un){
                return json_encode(['code'=>'1003','msg'=>'您已经领取过了']);
            }else{
                $res=User_CouponsModel::create($data);
            }
           
            if($res){ 
              return json_encode(['code'=>'0','msg'=>'领取成功']);
            //   print_r($data);
            }
    }
}
