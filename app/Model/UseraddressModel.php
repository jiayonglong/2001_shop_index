<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UseraddressModel extends Model
{
     protected $table = 'sh_user_address';
      protected $guarded = [];
      protected $primaryKey = "address_id";

      public $timestamps = false;
}
