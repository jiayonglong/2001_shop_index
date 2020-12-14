<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CodeModel extends Model
{
      protected $table = 'sh_code';
    protected $guarded = [];
    protected $primaryKey = "code_id";

    public $timestamps = false;
}
