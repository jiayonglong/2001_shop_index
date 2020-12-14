<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
     //指定表名
     protected $table = 'sh_menu';
     //指定主键
     protected $primaryKey = 'menu_id';
     //不自动添加时间 create_at update_at
     public $timestamps = false;
     //黑名单
     protected $guarded=[];
    public function p_list(){
        $data=self::where('parent_id','0')->get();
        return $data;
    }
     public function list_data(){
              
        $data=self::get();

        return $data;
    }

    public function create_data($data){
        $data=self::create($data);
        if($data){
           return $data;
        }
   
   }


    public function destroy_date($menu_id){
           $res=self::destroy($menu_id);
           return $res;
    }
    
}
