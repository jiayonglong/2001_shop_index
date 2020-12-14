<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_RoleModel extends Model
{
    //指定表名
    protected $table = 'sh_admin_role';
  
    //不自动添加时间 
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
