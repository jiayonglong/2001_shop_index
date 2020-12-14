<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
use App\Model\Shop_HistoryModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;
class ListController extends Controller
{
    /**列表页 */
    public function list($id){  
        /**获取商品的品牌和价格数据 */
        $query=request()->all();
        $query = $_SERVER['REDIRECT_QUERY_STRING']??'';
        $query = $query?'?'.$query:'';
        
        $url = 'http://2001.shop.api.com/getlist/'.$id.$query;

        /**历史浏览记录 展示*/
        $user_id = Redis::hget('reg','user_id');
        if(!$user_id){
            //不登录 历史浏览记录展示
            $listhistory = $this->cookielist();
            // $listhistory=$listhistory['listhistory'];
        }else{
            //登录后  历史浏览记录展示
            $urlv = 'http://2001.shop.api.com/listhistory';
            $story = geturl($urlv);
            $listhistory = $story['listhistory'];
        }
        
        // foreach($listhistory['listhistory'] as $v){
        // Redis::hmset('history','h_id',$v['h_id'],'user_id',$v['user_id'],'goods_id',$v['goods_id'],'add_time',$v['add_time'],'goods_name',$v['goods_name'],'goods_img',$v['goods_img'],'shop_price',$v['shop_price']);
        // }
        $urls = request()->url();
        $getlist = geturl($url);

        $brandInfo=$getlist['data']['brandInfo'];
        $priceInfo=$getlist['data']['priceInfo'];
        $goodsInfo=$getlist['data']['goodsInfo'];
        $query=$getlist['data']['query'];
        return view('list.list',['brandInfo'=>$brandInfo,'priceInfo'=>$priceInfo,'goodsInfo'=>$goodsInfo,'urls'=>$urls,'listhistory'=>$listhistory,'query'=>$query]);
    }

   /**登录后  清空历史浏览记录 */
    public function delhistorys(){
        $user_id=Redis::hget('reg','user_id');
        if(!$user_id){
            return redirect('/login');
        }
        $data['user_id']=$user_id;
        $url = 'http://2001.shop.api.com/delhistory';
        $delthistory = posturl($url,$data);
        if($delthistory['code']==0){
            return json_encode(['code'=>'0','msg'=>'删除浏览历史记录成功']);
        }
    }

    /**cookie历史浏览记录展示 */
    public function cookielist(){
        $cookiehistory = Cookie::get('historyInfo');
        $cookiehistory = unserialize($cookiehistory);
        
        if($cookiehistory){
            $goods_ids = array_column($cookiehistory,'goods_id');
            $cookiegoods = GoodsModel::whereIn('goods_id',$goods_ids)->take(6)->get()->toArray();
            return $cookiegoods;
        }else{
            return;
        }
    }





}
