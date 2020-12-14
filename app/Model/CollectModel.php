<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CollectModel extends Model
{
    protected $table = 'sh_collect';
    protected $guarded = [];
    protected $primaryKey = "collect_id";

    public $timestamps = false;

}
