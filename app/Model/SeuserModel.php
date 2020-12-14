<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SeuserModel extends Model
{
      //指定表面
    protected $table = 'sh_seuser';
    protected $primaryKey = 'seuser_id';
    public $timestamps = false;
}
