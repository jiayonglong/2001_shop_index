<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SeuserModel;
use App\Model\FirmModel;
class SellController extends Controller
{
    //商家后台首页或者商家资料展示
    public function index(){
        $seuser_id = session('seuser_id');

        // print_r($seuser_id);exit;
         $aes = FirmModel::where(['seuser_id'=>$seuser_id])->get();
        return view('admin.admin.index',['aes'=>$aes]);
    }
    //商家资料上传
    public function addindex(){
        return view('admin.admin.create');
    }
    //执行商家资料上传
    public function store(Request $Request){
        
        $data = $Request->except('_token');
         $seuser_id = session('seuser_id');
        // print_r($data);
         $t = SeuserModel::where(['firm_imgs'=>$firm_imgs])->first();
        if($t){
             return [
                    'code'=>'00004',
                    'message'=>'公司LOGO已存在',
                    'result'=>''
                ];
        }
         $goods = [
                        "firm_name" => $data['firm_name'],
                        "firm_tel" => $data['firm_tel'],
                        "firm_address" => $data['firm_address'],
                        "seuser_name" => $data['seuser_name'],
                        "seuser_qq"=> $data['seuser_qq'],
                        "seuser_email" => $data['seuser_email'],
                        "firm_img" => $data['firm_img'],
                        "firm_imgs" => $data['firm_imgs'],
                        "firm_desc" => $data['firm_desc'],
                        "seuser_id"=> $seuser_id
                    ];
        // print_r($goods);exit;
        $res = FirmModel::insert($goods);
        if($res){
        return redirect('/index');
            }else{
        echo "<script>alert('操作繁忙请稍后重试');location.href='/store'</script>";
        }
    }
}
