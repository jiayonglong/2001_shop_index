<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
     //指定表名
     protected $table = 'sh_admin';
     //指定主键
     protected $primaryKey = 'admin_id';
     //不自动添加时间 
     public $timestamps = false;
     //黑名单
     protected $guarded=[];

     public function create_data($data){
        $data['admin_pwd']=password_hash($data['admin_pwd'],PASSWORD_DEFAULT);
         $data=self::create($data);
         if($data){
            return redirect('admin.list');
         }
         
         
     }
     public function list_data(){
         $data=self::orderBy('admin_id','desc')->paginate(3);;
         return $data;
     }
     public function destroy_date($admin_id){
            $res=self::destroy($admin_id);
            return $res;
     }
}
