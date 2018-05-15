<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use SoftDeletes;

    protected $table = "rutas";

    public function conductor()
    {
        return $this->belongsTo('App\User','conductor_id');
    }

    public function acompanante()
    {
        return $this->belongsTo('App\User','acompañante_id');
    }

    public function registroRutas()
    {
        return $this->hasmany('App\RegistroRutas','rutas_id');
    }

}
