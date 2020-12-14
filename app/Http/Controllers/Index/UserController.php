<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UseraddressModel;
use App\Model\RegionModel;
use App\Model\UserModel;
use App\Model\Order_InfoModel;
use App\Model\Order_GoodsModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use function AlibabaCloud\Client\json;

class UserController extends Controller
{
    
    public function address(){
        $region = RegionModel::where('parent_id',0)->get();
        // $reg=json_encode(['data'=>$region]);
        return view('user.address',['region'=>$region]);
    }


    public function ser(){
        $user=Redis::hmget('reg','user_id','user_plone');
        if(!$user){
            return redirect('/login');
        }
        $data['user_id'] = $user[0];
        $url = "http://2001.shop.api.com/user";
        $data_json = posturl($url,$data);
        $obligation = $data_json['data']['obligation'];
        $deliver = $data_json['data']['deliver'];
        $afrmm = $data_json['data']['afrmm'];
        $evaluate = $data_json['data']['evaluate'];
        $remote_addr = $data_json['data']['remote_addr'];
        $plone = $user[1];
        return view('user.user',compact('obligation','deliver','afrmm','evaluate','remote_addr','plone'));
    }

    public function userorderlist(){
        $user=Redis::hmget('reg','user_id','user_plone');
        if(!$user){
            return redirect('/login');
        }
        $data['user_id'] = $user[0];
        $url = "http://2001.shop.api.com/obligation";
        $data_json = posturl($url,$data);
        // print_r($data_json);die;
        $data = $data_json['data'];
        // print_r($data);die;
        return view('user.order_list',compact('data'));
        
    }


    //修改密码
    public function changepwd(){
        $oldpwd = request()->oldpwd;
        $newpwd = request()->newpwd2;
        if(!$oldpwd || !$newpwd){
            return json_encode(['code'=>1,'msg'=>'Error，参数丢失']);
        }
        $user=Redis::hmget('reg','user_id','user_plone');
        $user_id = $user[0];
        $user_pwd = UserModel::where('user_id',$user_id)->value('user_pwd');
        if(!Hash::check($oldpwd, $user_pwd)){
            return json_encode(['code'=>'2','msg'=>'请输入正确的原始密码']);
       }
        $newpwd = bcrypt($newpwd);
        $change = UserModel::where('user_id',$user_id)->update(['user_pwd'=>$newpwd]);
        if($change){
            return json_encode(['code'=>'0','msg'=>'OK']);
        }else{
            return json_encode(['code'=>'3','msg'=>'修改失败']);
        }
    }





}
