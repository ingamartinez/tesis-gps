<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rfid extends Model
{
    use SoftDeletes;
    protected $table = "rfid";

    public function user()
    {
        return $this->hasOne('App\User','rfid_id');
    }

}
