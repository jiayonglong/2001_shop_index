<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table = 'sh_cart';
    protected $guarded = [];
    protected $primaryKey = "cart_id";

    public $timestamps = false;

}
