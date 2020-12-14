<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role_MenuModel extends Model
{
    //指定表名
    protected $table = 'sh_role_menu';
   
    //不自动添加时间 create_at update_at
    public $timestamps = false;
    //黑名单
    protected $guarded=[];

    public function addmenu($role_id){
        
    }

}
