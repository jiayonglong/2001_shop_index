<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SeckillModel;
use App\Model\GoodslModel;
use Illuminate\Support\Facades\Redis;
class SeckillController extends Controller
{
    public function seckill(){ 
        
        $data=SeckillModel::select('sh_seckill.*','sh_goods.*')->leftjoin('sh_goods','sh_seckill.goods_id','=','sh_goods.goods_id')->get();

        return  $data;
        
    }
    public function seckilldo(){
        $goods_id = request()->goods_id;
        $user_id=Redis::hget('reg','user_id');
        if(!$user_id){
            return json_encode(['code'=>'1001','msg'=>'请先登录']);
        }
        $ismember=Redis::sismember('shop'.$goods_id,$user_id); 
            if($ismember){
                return json_encode(['code'=>'1003','msg'=>'您已经抢过此商品']);
            }
             $seckill=Redis::lpop('seckill_'.$goods_id);
            if($seckill){
                Redis::sadd('shop'.$goods_id,$user_id);
              $data=  Redis::Smembers('shop'.$goods_id);  
              return json_encode(['code'=>'0','msg'=>'抢购成功']);
            //   print_r($data);
            }else{
                return json_encode(['code'=>'1002','msg'=>'此商品已被抢光']);
            }
        
        


    }
}
