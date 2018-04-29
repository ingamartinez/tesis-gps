<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    protected $table = "rfid";

    public function user()
    {
        return $this->hasOne('App\Users','rfid_id');
    }
}
