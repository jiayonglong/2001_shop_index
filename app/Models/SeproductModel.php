<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeproductModel extends Model
{
     protected $table = 'sh_seproducts';
      protected $guarded = [];
      protected $primaryKey = "product_id";

      public $timestamps = false;
}
