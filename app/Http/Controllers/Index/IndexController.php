<?php

namespace App\Http\Controllers\Index;
use App\Common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
use App\Model\NoticeModel;
class IndexController extends Controller
{
    /** 前台首页 */
    public function index(){
        //轮播图展示
        $url = "http://2001.shop.api.com/slideshow";
        $slideshow = geturl($url);    
        //  print_r($slideshow);
        $slideshow = serialize($slideshow);
        Redis::set('slideshow',$slideshow);
        $slideshow = unserialize($slideshow);

    //    $get = Redis::get('slideshow');
    //    $get = unserialize($get);
    //     print_r($get);exit;

         //首页商品数据
         $user_id=Redis::hmget('reg','user_id','user_plone');
         $url = "http://2001.shop.api.com/goodsInfo";
         $goodsInfo= geturl($url);
        //  print_r($goodsInfo);exit;

         $goodsInfo = serialize($goodsInfo);
         Redis::set('goodsInfo',$goodsInfo);
         $goodsInfo = unserialize($goodsInfo);
        //  $get = Redis::get('goodsInfo');
        //  $get = unserialize($get);
        //  print_r($get);exit;



         //goodslove   is_new
        //  $goodslove = serialize($goodsInfo);
        //  Reids::set('goodslove',$goodslove);
        //  $goodslove = unserialize($goodslove);

         //goodshot   is_hot
         //goodsbest  is_best

    

        //首页公告数据
        $url = "http://2001.shop.api.com/noticeinfo";
        $noticeinfo = geturl($url);

        $noticeinfo = serialize($noticeinfo);
        Redis::set('noticeinfo',$noticeinfo);
        $noticeinfo = unserialize($noticeinfo);
        

        return view('index.index',['slideshow'=>$slideshow['data'],'goodsInfo'=>$goodsInfo['data'],'user_id'=>$user_id,'noticeinfo'=>$noticeinfo['data']]);
       
    }

    public function search(){
        $search_val = request()->input('search_val');
        if(!$search_val){
            if($_SERVER['HTTP_REFERER'] == "http://2001.shop.index.com/search"){
                return view('index.search_list',['search_data'=>[]]);
            }else{
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $search_type = request()->input('search_type');

        if($search_type == 1){
            $data['search_val'] = $search_val;
            $url = "http://2001.shop.api.com/search";
            $search_data = posturl($url,$data);
            $data = $search_data['data'];
            // print_r($data);die;
            return view('index.search_list',['search_data'=>$data]);
        }else{
            $data['search_val'] = $search_val;
            $url = "http://2001.shop.api.com/search_a";
            $search_data = posturl($url,$data);
            $data = $search_data['data'];
            
            return view('index.seuser_list',['data'=>$data]);
        }
    }

    //商家商品
    public function seuser($id){
        if(!$id){
           echo "参数丢失";
           return false;
        }
        $data['id'] = $id;
        $url = "http://2001.shop.api.com/seuser_goods";
        $search_goods = posturl($url,$data);
        $data = $search_goods['data'];
        return view('index.search_list',['search_data'=>$data]);
    }




    //冒泡排序
    public function maopao(){
       $arr = [3,69,9,100,32,67];
        if(!is_array($arr)){
            return;
        }
        if(count($arr) < 2){
            return;
        }
        $len = count($arr);
        for($i=0;$i<$len-1;$i++){
            for($j=$i+1;$j<$len;$j++){
                if($arr[$i] > $arr[$j]){
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        print_r($arr);die;
    }


    




}
