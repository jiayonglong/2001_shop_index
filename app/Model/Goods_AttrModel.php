<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods_AttrModel extends Model
{
     protected $table = 'sh_goods_attr';
      protected $guarded = [];
      protected $primaryKey = "attr_id";

      public $timestamps = false;
}
