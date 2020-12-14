<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SeuserModel;
use Illuminate\Support\Facades\Redis;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Hash;
class BusinessController extends Controller
{
    //商家入驻
    public function sereg(){
        return view('admin.business.union_reg');
    }
    public function seregdo(Request $request){
        $seuser_plone = $request->post('seuser_plone');
        $seuser_name = $request->post('seuser_name');
        $seuser_pwd = $request->post('seuser_pwd');

        $seuser_pwds = $request->post('seuser_pwds');
        $code = $request->post('code');
        $codes=Redis::get('forgetcode');
        // $codes = 111111;
         if($code!=$codes){  
            return [
                    'code'=>'00005',
                    'message'=>'验证码错误',
                    'result'=>''
                ];
        }
        $t = SeuserModel::where(['seuser_plone'=>$seuser_plone])->first();
        if($t){
             return [
                    'code'=>'00004',
                    'message'=>'手机号已存在',
                    'result'=>''
                ];
        }
        

        
        $seuser_pwd = bcrypt($seuser_pwd);

       
    
             $data = [
            'seuser_plone' => $seuser_plone,
            'seuser_name'=>$seuser_name,
            'seuser_pwd'=>$seuser_pwd,
            ];
             $res = SeuserModel::insert($data);
             if(!$res){
             return [
                    'code'=>'00003',
                    'message'=>'注册失败',
                    'result'=>''
                ];
        }else{
             return [
                    'code'=>'00000',
                    'message'=>'注册成功',
                    'result'=>''
                ];
        }
    }
    //手机验证码验证
    public function sendSMS()
    {
        $name = request()->name;
        $code = rand(10000,999999);
        // $code ="11223";
        $result = $this->send($name,$code);
        if($result['Message']=='OK'){
                $respoer = [
                    'code'=>'00001',
                    'message'=>'发送成功',
                    'result'=>''
                ];
        }else{
                $respoer = [
                    'code'=>'00002',
                    'message'=>'发送失败',
                    'result'=>''
                ];

        }
        return json_encode($respoer);

    }
    //短信验证
    public function send($name,$code){
        Redis::del('forgetcode');
        Redis::setex('forgetcode',24*60*60,$code);
        AlibabaCloud::accessKeyClient('LTAI4GFccq2jJ5vjx9C1XNir', 'V97fmw5pHOmq5J0ij8RUZtQgdXDSko')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $name,
                        'SignName' => "龙龙小草",
                        'TemplateCode' => "SMS_182665157",
                        'TemplateParam' => "{code:$code}",
                    ],
                ])
                ->request();
            print_r($result->toArray());
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
    }
    //商家登录
    public function business(){
        return view('admin.business.union_login');
    }
    //商家登录
     public function selogin(Request $request){
        $post = request()->except('_token');
        // print_r($post);
        $zbc = SeuserModel::where(['seuser_plone'=>$post['seuser_plone'],"seuser_start"=>1])->first();
        if(!$zbc){
            return json_encode(['code'=>'00003','msg'=>'此账号审核中']);
        }
        $admin = SeuserModel::where(['seuser_plone'=>$post['seuser_plone']])->first();
        // print_r($admin);
        if(!$admin){
            return json_encode(['code'=>'00002','msg'=>'没有此账号']);
        }
        if(!Hash::check($post['seuser_pwd'], $admin->seuser_pwd)){
            return json_encode(['code'=>'00004','msg'=>'账号密码错误']);
        }
         session(['seuser_plone'=>$admin->seuser_plone,'seuser_id'=>$admin->seuser_id]);
         session(['seuser_id'=>$admin->seuser_id]);
        return json_encode(['code'=>'00000','msg'=>'登录成功']);
   }
   //商家退出
   public function loginout(){
        session(['seuser_plone'=>null]);
        return redirect('/business');die;
   }
}
