<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
     //指定表面
    protected $table = 'sh_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
