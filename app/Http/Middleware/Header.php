<?php

namespace App\Http\Middleware;
use App\Model\CartgoryModel;
use Illuminate\Support\Facades\Redis;
use Closure;

class Header
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $user_id = Redis::hget('reg','user_id');
        $datas['user_id'] = $user_id;
        //首页菜单栏
        $data = CartgoryModel::get();
        $cartgoryInfo = infinite($data);
        //购物车商品数量
        $url = "http://2001.shop.api.com/cart_count";
        $count_cart = posturl($url,$datas);
        $request->merge(['cartgoryInfo' => $cartgoryInfo,'count_cart' => $count_cart]);
        // view()->share('cartgoryInfo',$cartgoryInfo);
        // view()->share('count_cart',$count_cart);
        return $next($request);
    }
}
