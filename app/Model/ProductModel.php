<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
     protected $table = 'sh_products';
      protected $guarded = [];
      protected $primaryKey = "product_id";

      public $timestamps = false;
}
