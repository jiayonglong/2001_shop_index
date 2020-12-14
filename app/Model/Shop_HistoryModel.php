<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop_HistoryModel extends Model
{
    protected $table = 'sh_shop_history';
    protected $guarded = [];
    protected $primaryKey = "h_id";

    public $timestamps = false;
}
