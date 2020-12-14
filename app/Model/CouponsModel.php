<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CouponsModel extends Model
{
    protected $table = 'sh_coupons';
    protected $guarded = [];
    protected $primaryKey = "coupons_id";

    public $timestamps = false;

}
