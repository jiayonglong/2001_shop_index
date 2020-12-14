<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
     protected $table = 'sh_brand';
      protected $guarded = [];
      protected $primaryKey = "brand_id";

      public $timestamps = false;
}
