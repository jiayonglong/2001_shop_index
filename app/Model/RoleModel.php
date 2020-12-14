<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
      //指定表名
      protected $table = 'sh_role';
      //指定主键
      protected $primaryKey = 'role_id';
      //不自动添加时间 create_at update_at
      public $timestamps = false;
      //黑名单
      protected $guarded=[];


      public function create_data($data){
         $data=self::create($data);
         if($data){
            return redirect('role.list');
         }
    
    }
    public function roleinfo(){
        $role=self::get();
        return $role;
    }
    public function list_data(){
        $data=self::orderBy('role_id','desc')->paginate(3);;
        return $data;
    }

    public function destroy_date($role_id){
        $res=self::destroy($role_id);
        return $res;
 }
}