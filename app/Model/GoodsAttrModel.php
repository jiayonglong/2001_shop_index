<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsAttrModel extends Model
{
      protected $table = 'sh_attribute';
      protected $guarded = [];
      protected $primaryKey = "attr_id";

      public $timestamps = false;
}
