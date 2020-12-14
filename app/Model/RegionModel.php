<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
     //指定表名
    protected $table = 'sh_region';
      protected $guarded = [];
      protected $primaryKey = "region_id";

      public $timestamps = false;
}
