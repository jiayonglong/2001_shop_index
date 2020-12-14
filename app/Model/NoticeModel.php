<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NoticeModel extends Model
{
    protected $table = 'sh_notice';
      protected $guarded = [];
      protected $primaryKey = "notice_id";

      public $timestamps = false;
}
