<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeckillController extends Controller
{
    public function index(){
        $url = 'http://2001.shop.api.com/seckill';

        $data = geturl($url);
        // print_r($data);die;
        return view('seckill/index',['data'=>$data]);
    }

}
