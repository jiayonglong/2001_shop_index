<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsTypeModel extends Model
{
      protected $table = 'sh_goodstype';
      protected $guarded = [];
      protected $primaryKey = "cat_id";

      public $timestamps = false;
}
