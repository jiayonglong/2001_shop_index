<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FirmModel extends Model
{
     protected $table = 'sh_firm';
    protected $guarded = [];
    protected $primaryKey = "firm_id";

    public $timestamps = false;

}
