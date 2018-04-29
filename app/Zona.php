<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zona extends Model
{
    use SoftDeletes;

    protected $table = 'zonas';
    protected $dates = ['deleted_at'];

    public function arduinos()
    {
        return $this->hasMany('App\Arduino','zonas_id');
    }
}
