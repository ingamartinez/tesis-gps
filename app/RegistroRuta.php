<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroRuta extends Model
{
    protected $table = "registro_rutas";

    protected $dates = ['created_at','updated_at','fecha_inicio'];


    public function ruta(){
        return $this->hasOne('App\Ruta','rutas_id');
    }

}
