<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
use App\Model\NoticeModel;
use App\Model\FirmModel;
use App\Model\SeuserModel;
use function AlibabaCloud\Client\json;
class IndexController extends Controller
{
    /**首页分类数据 */
    public function cartgory(){
        $cartgoryInfo = CartgoryModel::get();
        $category = infinite($cartgoryInfo);
        return json_encode($category);
    }    

    /**首页商品表中轮播图数据 */
    public function slideshow(){
        $slideshow = GoodsModel::getslicedata();
        $reposer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=> $slideshow
        ];
        return json_encode($reposer);
    }

    /**首页商品数据数据 */
    public function goodsInfo(){

        $goodslove = GoodsModel::select('goods_name','goods_img','goods_id')->where('is_new','=',1)->limit(8)->get();
        $goodshot = GoodsModel::select('goods_name','goods_img','goods_id')->where('is_hot','=',1)->orderBy('goods_id','desc')->limit(10)->get();
        $goodsbest=GoodsModel::select('goods_name','goods_img','goods_id')->where('is_best','=',1)->orderBy('shop_price','ASC')->limit(5)->get();
        
        $reposer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>[
                'goodslove'=>$goodslove,
                'goodshot'=>$goodshot,
                'goodsbest'=>$goodsbest,
            ]
        ];
        
        return json_encode($reposer);
    }

    /**首页公告数据 */
    public function noticeinfo(){
        $noticeinfo = NoticeModel::limit(8)->get();
        $reposer = [
            'code'=>0,
            'msg'=>'OK',
            'data'=>$noticeinfo,
        ];
        return json_encode($reposer);
    }

    //搜索
    public function search(){
        $search_val = request()->input('search_val');
        if(!$search_val){
            $reposer = [
                'code'=>1,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }
        $where1 = [];
        if($search_val){
            $where1[] = ['goods_name','like',"%$search_val%"];
        }

        $search_data = GoodsModel::select('goods_id','goods_name','goods_img')->where($where1)->get();
        // print_r($search_data);die;
        if($search_data){
            $reposer = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$search_data,
            ]; 
        }else{
            $reposer = [
                'code'=>2,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }    
        return json_encode($reposer);

    }
    public function search_a(){
        $search_val = request()->input('search_val');
        if(!$search_val){
            $reposer = [
                'code'=>1,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }
        $where1 = [];
        $where1[] = ['seuser_name','like',"%$search_val%"];
        $where1[] = ['seuser_start','=',1];

        $search_id = SeuserModel::select('seuser_id')->where($where1)->get();
        $search_data = [];
        foreach($search_id as $k=>$v){
            $v['logo'] = FirmModel::select('firm_imgs')->where(['seuser_id'=>$v['seuser_id']])->get();
            $search_data[] = $v;
        }
        if(count($search_data) >= 1){
            $reposer = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$search_data,
            ]; 
        }else{
            $reposer = [
                'code'=>2,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }    
        return json_encode($reposer);
    }


    public function seuser_goods(){
        $id = request()->input('id');
        if(!$id){
            $reposer = [
                'code'=>1,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }

        $seuser_goods = GoodsModel::select('goods_id','goods_name','goods_img')->where('seuser_id',$id)->get();
        if($seuser_goods){
            $reposer = [
                'code'=>0,
                'msg'=>'OK',
                'data'=>$seuser_goods,
            ]; 
        }else{
            $reposer = [
                'code'=>2,
                'msg'=>'Error',
                'data'=>[],
            ]; 
        }    
        return json_encode($reposer);
    }

}