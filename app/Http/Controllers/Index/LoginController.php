<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }
    public function reg(){
        return view('login.reg');
    }

    public function logindo(Request $request){
       $data['user_plone'] = $request->user_plone;
       $data['user_pwd'] = $request->user_pwd;
       $url = "http://2001.shop.api.com/logindo";
       $res= $this->posturl($url,$data);
    //    print_r($res);die;
        if($res['code']=='00000'){
            // dd($res);
             Redis::Hmset('reg','token',$res['token'],'user_id',$res['user']["user_id"],'user_plone',$res['user']["user_plone"]);

            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }


    public function posturl($url,$data){
            if(is_array($data)){
                $data = json_encode($data);
            }
           
            $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
            $curl = curl_init();//初始化
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
            curl_setopt($curl, CURLOPT_POST, true);//设置post提交
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//post提交表单数据
            curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
           
            // print_r($output);die;
            // print_r(curl_errno($curl));die;
            // echo $output;exit;
            curl_close($curl);
            if(is_null(json_decode($output,true))){
                return $output;
            }
            return json_decode($output,true);
        } 

        public function logout(){
           Redis::hdel('reg','user_id','user_plone');
           return redirect('/login');
        }


        //忘记密码
        public function find_pwd(){
            return view('login.find_pwd');
        }
        
        //找回密码
        public function find_pwddo(){
            $plone = request()->input('plone');
            $code = rand(100000,999999);
            
            $data['name'] = $plone;
            $data['code'] = $code;
            $url = "http://2001.shop.api.com/send_s";
            $code_data = posturl($url,$data);
            if($code_data['code'] == 0){
                return json_encode(['code'=>0,'msg'=>'OK，发送成功']);
            }else{
                return json_encode(['code'=>1,'msg'=>'Error,验证码发送失败']);
            }
        }

        //修改密码
        
        public function find_pwds(){
            $plone = request()->input('plone');
            $code = request()->input('code');
            $pwd = request()->input('pwd');
            
            if(!$plone || !$code || !$pwd){
                return json_encode(['code'=>1,'msg'=>'Error,参数丢失']);die;
            }

            $data['plone'] = $plone;
            $data['code'] = $code;
            $data['pwd'] = $pwd;

            $url = "http://2001.shop.api.com/change_pwd";
            $change_pwd = posturl($url,$data);
            if($change_pwd['code'] == 0){
                return json_encode(['code'=>0,'msg'=>'OK']);
            }else if($change_pwd['code'] == 1){
                return json_encode(['code'=>1,'msg'=>'未查询到您输入的手机号码']);
            }else if($change_pwd['code'] == 2){
                return json_encode(['code'=>2,'msg'=>'请输入正确的验证码']);
            }else{
                return json_encode(['code'=>3,'msg'=>'操作繁忙']);
            }




        }
}
