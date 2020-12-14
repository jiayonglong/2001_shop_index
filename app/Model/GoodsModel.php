<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
      protected $table = 'sh_goods';

      protected $guarded = [];
      protected $primaryKey = "goods_id";
      public $timestamps = false;
      //首页轮播图
      public static function getslicedata(){
            return self::select('goods_id','goods_img')->where(['is_new'=>1,'is_hot'=>1,'is_best'=>1])->take(3)->orderBy('shop_price','desc')->get();
      }
}