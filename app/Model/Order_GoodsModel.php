<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_GoodsModel extends Model
{
    //指定表名
    protected $table = 'sh_order_goods';
    //指定主键
    protected $primaryKey = 'order_shop_id';
    //不自动添加时间 
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
