<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use SoftDeletes;

    protected $table = 'registro';

    protected $dates = ['deleted_at'];

    public function getMovimientoAttribute($value)
    {
    	if ($value === "SI") {
    		return 1;
    	}elseif ($value === "NO") {
    		return 0;
    	}        
    }
}
