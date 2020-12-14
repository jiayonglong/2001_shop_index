<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SegoodsModel extends Model
{
     protected $table = 'sh_segoods';
      protected $guarded = [];
      protected $primaryKey = "goods_id";

      public $timestamps = false;
}
