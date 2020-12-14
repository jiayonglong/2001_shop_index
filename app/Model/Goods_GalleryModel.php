<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods_GalleryModel extends Model
{
     protected $table = 'sh_goods_gallery';
      protected $guarded = [];
      protected $primaryKey = "img_id";

      public $timestamps = false;
}
